<?php

namespace App\Http\Controllers\Foundation\Librarian;

use App\Http\Requests\LibraryServiceStoreRequest;
use App\Models\LibraryService;
use App\Repositories\BookshelfRepository;
use App\Repositories\LibraryServiceRepository;
use App\Repositories\ReadercardRepository;

class ServiceMovementController extends BaseController
{
    /**
     * @var BookshelfRepository
     */
    private $bookshelfRepository;

    /**
     * @var LibraryServiceRepository
     */
    private $serviceRepository;

    /**
     * @var ReadercardRepository
     */
    private $readercardRepository;

    public function __construct()
    {
        parent::__construct();
        $this->bookshelfRepository = app(BookshelfRepository::class);
        $this->serviceRepository = app(LibraryServiceRepository::class);
        $this->readercardRepository = app(ReadercardRepository::class);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function listOptions()
    {
        $libraryId = session('working_library_id');

        $bookshelvesPagination = $this->bookshelfRepository
            ->getAllByLibraryId($libraryId);
        return view('librarian.service.options',
            compact('bookshelvesPagination'));
    }

    /**
     * @param int $bookshelfId
     * @return \Illuminate\View\View
     */
    public function specifyService($bookshelfId)
    {
        $bookshelf = $this->bookshelfRepository->getEdit($bookshelfId);
        if (empty($bookshelf)) abort(404);

        return view('librarian.service.specify',
            compact('bookshelf'));
    }

    /**
     * @param LibraryServiceStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmService(LibraryServiceStoreRequest $request)
    {
        $data = $request->all();

        $service = new LibraryService();
        $bookshelf = $this->bookshelfRepository->getEdit($data['bookshelf_id']);

        $service->readercard_id = $this->readercardRepository
            ->getIdByCode($data['readercard_code']);
        $bookshelf->exemplars_in_stock -= $data['exemplars_given'];

        $serviceSaved = $service->fill($data)->save();
        $bookshelfUpdated = $bookshelf->update();

        if ($serviceSaved && $bookshelfUpdated) {
            return redirect()
                ->route('librarian.panel')
                ->with(['success' => 'Операція позичання проведена успішно.']);
        } else {
            return back()
                ->withErrors(['msg' => 'Не вдалося провести видачу.'])
                ->withInput();
        }
    }

    public function listGetBack($readercardCode)
    {
        $readercardId = $this->readercardRepository
            ->getIdByCode($readercardCode);

        $servicesPagination = $this->serviceRepository
            ->getServiceGetBackOptions(
                session('working_library_id'),
                $readercardId);


    }

    public function confirmGetBack($request)
    {

    }
}
