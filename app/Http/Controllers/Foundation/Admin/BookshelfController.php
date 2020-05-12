<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Http\Requests\BookshelfFormRequest;
use App\Models\Bookshelf;
use App\Repositories\BookshelfRepository;
use App\Repositories\LibraryRepository;
use App\Repositories\PrintingRepository;
use Illuminate\Http\Request;

class BookshelfController extends BaseController
{
    /**
     * @property BookshelfRepository
     */
    private $bookshelfRepository;

    /**
     * @property LibraryRepository
     */
    private $libraryRepository;

    /**
     * @property PrintingRepository
     */
    private $printingRepository;

    public function __construct()
    {
        parent::__construct();
        $this->bookshelfRepository = app(BookshelfRepository::class);
        $this->libraryRepository = app(LibraryRepository::class);
        $this->printingRepository = app(PrintingRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $bookshelvesPagination = $this->bookshelfRepository
            ->getAllWithPagination(15, false);

        return view('admin.bookshelves.index',
            compact('bookshelvesPagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $libraryOptions = $this->libraryRepository
            ->getSelectOptions();
        $printingOptions = $this->printingRepository
            ->getSelectOptions();

        return view('admin.bookshelves.create',
            compact('printingOptions', 'libraryOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookshelfFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookshelfFormRequest $request)
    {
        $bookshelf = new Bookshelf();

        $data = $request->all();
        $result = $bookshelf->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('admin.bookshelves.edit', $bookshelf->id)
                ->with(['success' => 'Запис успішно збережено.']);
        } else {
            return back()
                ->withErrors(['msg' => "Помилка збереження запису."])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $bookshelf = $this->bookshelfRepository->getEdit($id);
        if (empty($bookshelf)) abort(404);

        return view('admin.bookshelves.edit',
            compact('bookshelf'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookshelfFormRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BookshelfFormRequest $request, $id)
    {
        $bookshelf = $this->bookshelfRepository->getEdit($id);

        if (empty($bookshelf)) {
            return back()
                ->withErrors(['msg' => "Запис з ідентифікатором [{$id}] не знайдено."])
                ->withInput();
        }

        $data = $request->all();
        $result = $bookshelf->fill($data)->update();

        if ($result) {
            return redirect()
                ->route('admin.bookshelves.edit', $id)
                ->with(['success' => 'Запис успішно збережено.']);
        } else {
            return back()
                ->withErrors(['msg' => "Помилка збереження запису."])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
