<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Http\Requests\PrintingStoreRequest;
use App\Http\Requests\PrintingUpdateRequest;
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
    private $authorRepository;

    /**
     * @var PrintingPubhouseRepository
     */
    private $pubhouseRepository;

    /**
     * @var PrintingTypeRepository
     */
    private $typeRepository;

    /**
     * @var PrintingGenreRepository
     */
    private $genreRepository;

    public function __construct()
    {
        parent::__construct();
        $this->printingRepository = app(PrintingRepository::class);
        $this->authorRepository = app(PrintingAuthorRepository::class);
        $this->pubhouseRepository = app(PrintingPubhouseRepository::class);
        $this->typeRepository = app(PrintingTypeRepository::class);
        $this->genreRepository = app(PrintingGenreRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $printingsPagination = $this->printingRepository
            ->getAllWithPagination(10);
        return view('admin.printings.index',
            compact('printingsPagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $authorOptions = $this->authorRepository
            ->getSelectOptions();
        $pubhouseOptions = $this->pubhouseRepository
            ->getSelectOptions();
        $typeOptions = $this->typeRepository
            ->getSelectOptions();
        $genreOptions = $this->genreRepository
            ->getMultiSelectOptions();

        return view('admin.printings.create',
            compact('authorOptions', 'pubhouseOptions',
                'typeOptions', 'genreOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PrintingStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PrintingStoreRequest $request)
    {
        $result = $this->printingRepository
            ->saveModel($request->all());

        if ($result['succeed']) {
            return redirect()
                ->route('admin.printings.edit', $result['id'])
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $printing = $this->printingRepository->getEdit($id);
        if (empty($printing)) abort(404);

        $authorOptions = $this->authorRepository
            ->getSelectOptions($printing->printing_author_id);
        $pubhouseOptions = $this->pubhouseRepository
            ->getSelectOptions($printing->printing_pubhouse_id);
        $typeOptions = $this->typeRepository
            ->getSelectOptions($printing->printing_type_id);
        $genreOptions = $this->genreRepository
            ->getMultiSelectOptions($printing->genres->pluck('id')->toArray());

        return view('admin.printings.edit',
            compact('printing', 'authorOptions',
                'pubhouseOptions', 'typeOptions', 'genreOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PrintingUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PrintingUpdateRequest $request, $id)
    {
        $printing = $this->printingRepository->getEdit($id);

        if (empty($printing)) {
            return back()
                ->withErrors(['msg' => "Запис з ідентифікатором [{$id}] не знайдено."])
                ->withInput();
        }

        $result = $this->printingRepository
            ->updateModel($printing, $request->all());

        if ($result) {
            return redirect()
                ->route('admin.printings.edit', $id)
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
