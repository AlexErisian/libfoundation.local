<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Http\Requests\PrintingPubhouseFormRequest;
use App\Models\PrintingPubhouse;
use App\Repositories\PrintingPubhouseRepository;

class PrintingPubhouseController extends BaseController
{
    /**
     * @var PrintingPubhouseRepository
     */
    private $printingPubhouseRepository;

    public function __construct()
    {
        parent::__construct();
        $this->printingPubhouseRepository = app(PrintingPubhouseRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pubhousesPagination = $this->printingPubhouseRepository
            ->getAllWithPagination(15);
        return view('admin.printing-pubhouses.index',
            compact('pubhousesPagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.printing-pubhouses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PrintingPubhouseFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PrintingPubhouseFormRequest $request)
    {
        $pubhouse = new PrintingPubhouse();

        $data = $request->all();

        $result = $pubhouse->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('admin.printing-pubhouses.edit', $pubhouse->id)
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
        $pubhouse = $this->printingPubhouseRepository->getEdit($id);
        if(empty($pubhouse)) abort(404);
        return view('admin.printing-pubhouses.edit',
            compact('pubhouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PrintingPubhouseFormRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PrintingPubhouseFormRequest $request, $id)
    {
        $pubhouse = $this->printingPubhouseRepository->getEdit($id);

        if (empty($pubhouse)) {
            return back()
                ->withErrors(['msg' => "Запис з ідентифікатором [{$id}] не знайдено."])
                ->withInput();
        }

        $data = $request->all();

        $result = $pubhouse->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('admin.printing-pubhouses.edit', $id)
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
