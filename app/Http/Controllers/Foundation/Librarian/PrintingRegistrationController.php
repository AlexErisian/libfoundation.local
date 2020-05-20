<?php

namespace App\Http\Controllers\Foundation\Librarian;

use App\Repositories\LibraryRepository;
use App\Repositories\PrintingRegistrationRepository;
use Illuminate\Http\Request;

class PrintingRegistrationController extends BaseController
{
    /**
     * @var LibraryRepository
     */
    private $libraryRepository;

    /**
     * @var PrintingRegistrationRepository
     */
    private $printingRegistrationRepository;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('library');
        $this->libraryRepository = app(LibraryRepository::class);
        $this->printingRegistrationRepository = app(PrintingRegistrationRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $printingRegistrationsPagination = $this->libraryRepository
            ->getAllRegistrationsInLibrary(session('working_library_id'));

        return view('librarian.printing-registrations.index',
            compact('printingRegistrationsPagination'));
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
        $printingRegistration = $this->printingRegistrationRepository->getEdit($id);
        if(empty($printingRegistration)) abort(404);

        return view('librarian.printing-registrations.show',
            compact('printingRegistration'));
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
