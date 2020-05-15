<?php

namespace App\Http\Controllers\Foundation\Librarian;

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
        $bookshelves = $this->bookshelfRepository
            ->getAllByLibraryId($libraryId);
        dd($bookshelves);
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
