<?php

namespace App\Http\Controllers\Foundation;

use App\Repositories\PrintingAuthorRepository;
use App\Repositories\PrintingGenreRepository;
use App\Repositories\PrintingPubhouseRepository;
use App\Repositories\PrintingRepository;
use App\Repositories\PrintingTypeRepository;
use Illuminate\Http\Request;

class PrintingController extends BaseController
{
    /**
     * @var PrintingRepository
     */
    private $printingRepository;

    /**
     * @var PrintingAuthorRepository
     */
    private $printingAuthorRepository;

    /**
     * @var PrintingPubhouseRepository
     */
    private $printingPubhouseRepository;

    /**
     * @var PrintingTypeRepository
     */
    private $printingTypeRepository;

    /**
     * @var PrintingGenreRepository
     */
    private $printingGenreRepository;

    public function __construct()
    {
        parent::__construct();
        $this->printingRepository = app(PrintingRepository::class);
        $this->printingAuthorRepository = app(PrintingAuthorRepository::class);
        $this->printingPubhouseRepository = app(PrintingPubhouseRepository::class);
        $this->printingTypeRepository = app(PrintingTypeRepository::class);
        $this->printingGenreRepository = app(PrintingGenreRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $printingsPagination = null;

        if(!empty($data['filter_applied']))
        {
            $printingsPagination = $this->printingRepository->applyFilter($data);
        } else {
            $printingsPagination = $this->printingRepository->getForIndexPage(10);
        }

        $authorOptions = $this->printingAuthorRepository
            ->getSelectOptions();
        $pubhouseOptions = $this->printingPubhouseRepository
            ->getSelectOptions();
        $typeOptions = $this->printingTypeRepository
            ->getSelectOptions();
        $genreOptions = $this->printingGenreRepository
            ->getMultiSelectOptions();

        return view('printings.index',
            compact('printingsPagination',
                'authorOptions', 'pubhouseOptions',
                'typeOptions', 'genreOptions'));
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
