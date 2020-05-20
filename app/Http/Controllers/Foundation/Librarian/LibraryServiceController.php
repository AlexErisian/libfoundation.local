<?php

namespace App\Http\Controllers\Foundation\Librarian;

use App\Repositories\LibraryRepository;
use App\Repositories\LibraryServiceRepository;
use Illuminate\Http\Request;

class LibraryServiceController extends BaseController
{
    /**
     * @var LibraryRepository
     */
    private $libraryRepository;

    /**
     * @var LibraryServiceRepository
     */
    private $libraryServiceRepository;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('library');
        $this->libraryRepository = app(LibraryRepository::class);
        $this->libraryServiceRepository = app(LibraryServiceRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $libraryServicesPagination = $this->libraryRepository
            ->getAllServicesInLibrary(session('working_library_id'));

        return view('librarian.library-services.index',
            compact('libraryServicesPagination'));
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
        $libraryService = $this->libraryServiceRepository->getEdit($id);
        if(empty($libraryService)) abort(404);

        return view('librarian.library-services.show',
            compact('libraryService'));
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
