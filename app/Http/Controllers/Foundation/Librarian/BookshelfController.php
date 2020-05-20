<?php

namespace App\Http\Controllers\Foundation\Librarian;

use App\Models\Bookshelf;
use App\Repositories\BookshelfRepository;
use Illuminate\Http\Request;

class BookshelfController extends BaseController
{
    /**
     * @var BookshelfRepository
     */
    private $bookshelfRepository;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('library');
        $this->bookshelfRepository = app(BookshelfRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        $libraryId = session('working_library_id');
        $bookshelvesPagination = $this->bookshelfRepository
            ->getAllByLibraryId($libraryId);

        return view('librarian.bookshelves.index',
            compact('bookshelvesPagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $bookshelf = Bookshelf::withTrashed()->find($id);
        if(empty($bookshelf)) abort(404);

        return view('librarian.bookshelves.show',
            compact('bookshelf'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
