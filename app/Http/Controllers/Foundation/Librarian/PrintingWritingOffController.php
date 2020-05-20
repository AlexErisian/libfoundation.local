<?php

namespace App\Http\Controllers\Foundation\Librarian;

use App\Repositories\LibraryRepository;
use App\Repositories\PrintingWritingOffRepository;
use Illuminate\Http\Request;

class PrintingWritingOffController extends BaseController
{
    /**
     * @var LibraryRepository
     */
    private $libraryRepository;

    /**
     * @var PrintingWritingOffRepository
     */
    private $printingWritingOffRepository;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('library');
        $this->libraryRepository = app(LibraryRepository::class);
        $this->printingWritingOffRepository = app(PrintingWritingOffRepository::class);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $printingWritingOffsPagination = $this->libraryRepository
            ->getAllWritingOffsInLibrary(session('working_library_id'));

        return view('librarian.printing-writing-offs.index',
            compact('printingWritingOffsPagination'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $printingWritingOff = $this->printingWritingOffRepository->getEdit($id);
        if(empty($printingWritingOff)) abort(404);

        return view('librarian.printing-writing-offs.show',
            compact('printingWritingOff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
