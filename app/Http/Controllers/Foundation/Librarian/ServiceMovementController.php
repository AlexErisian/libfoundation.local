<?php

namespace App\Http\Controllers\Foundation\Librarian;

use App\Http\Requests\LibraryServiceStoreRequest;
use App\Models\Bookshelf;
use App\Models\LibraryService;
use App\Repositories\BookshelfRepository;
use App\Repositories\LibraryRepository;
use App\Repositories\ReadercardRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServiceMovementController extends BaseController
{
    /**
     * @var BookshelfRepository
     */
    private $bookshelfRepository;

    /**
     * @var LibraryRepository
     */
    private $libraryRepository;

    /**
     * @var ReadercardRepository
     */
    private $readercardRepository;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('library');
        $this->bookshelfRepository = app(BookshelfRepository::class);
        $this->libraryRepository = app(LibraryRepository::class);
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

        DB::beginTransaction();

        $serviceSaved = $service->fill($data)->save();
        $bookshelfUpdated = $bookshelf->update();

        if ($serviceSaved && $bookshelfUpdated) {
            DB::commit();
            return redirect()
                ->route('librarian.panel')
                ->with(['success' => 'Операція позичання проведена успішно.']);
        } else {
            DB::rollBack();
            return back()
                ->withErrors(['msg' => 'Не вдалося провести видачу.'])
                ->withInput();
        }
    }

    /**
     * @return \Illuminate\View\View
     */
    public function enterCodeOptional()
    {
        return view('librarian.service.enter_code_optional');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectReadercardId(Request $request)
    {
        $data = $request->all();
        $readercardId = $this->readercardRepository
            ->getIdByCode($data['readercard_code']);

        if (!empty($readercardId)) {
            return redirect()
                ->route('librarian.service.get-back', $readercardId);
        } else {
            return back()
                ->withErrors(['msg' => 'Не знайдено такого читацького квитку у базі. Перевірте правильність введеного коду.'])
                ->withInput();
        }
    }

    public function listGetBack($readercardId = 0)
    {
        $libraryServicesPagination = $this->libraryRepository
            ->getServiceGetBackOptions(session('working_library_id'),
                $readercardId);

        return view('librarian.service.get_back_options',
            compact('libraryServicesPagination'));
    }

    public function confirmGetBack($libraryServiceId)
    {
        $service = LibraryService::find($libraryServiceId);
        $bookshelf = Bookshelf::find($service->bookshelf_id);

        if (empty($service)) {
            return back()
                ->withErrors("Запису позичення з id [{$libraryServiceId}] не існує.");
        }
        if (empty($bookshelf)) {
            return back()
                ->withErrors("Запису зберігання з id [{$service->bookshelf_id}] не існує.");
        }

        $service->returned_at = Carbon::now();
        $bookshelf->exemplars_in_stock += $service->exemplars_given;

        DB::beginTransaction();

        $serviceUpdated = $service->update();
        $bookshelfUpdated = $bookshelf->update();

        if ($serviceUpdated && $bookshelfUpdated) {
            DB::commit();
            return redirect()
                ->route('librarian.panel')
                ->with(['success' => 'Операція повернення видань проведена успішно.']);
        } else {
            DB::rollBack();
            return back()
                ->withErrors(['msg' => 'Не вдалося провести повернення видань.']);
        }
    }
}
