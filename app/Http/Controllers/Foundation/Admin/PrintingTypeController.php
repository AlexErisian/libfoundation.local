<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Http\Requests\PrintingTypeFormRequest;
use App\Models\PrintingType;
use App\Repositories\PrintingTypeRepository;

class PrintingTypeController extends BaseController
{
    /**
     * @var PrintingTypeRepository
     */
    private $printingTypeRepository;

    public function __construct()
    {
        parent::__construct();
        $this->printingTypeRepository = app(PrintingTypeRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $typesPagination = $this->printingTypeRepository
            ->getAllWithPagination(15);
        return view('admin.printing-types.index',
            compact('typesPagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.printing-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PrintingTypeFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PrintingTypeFormRequest $request)
    {
        $type = new PrintingType();

        $data = $request->all();

        $result = $type->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('admin.printing-types.edit', $type->id)
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
        $type = $this->printingTypeRepository->getEdit($id);
        if(empty($type)) abort(404);
        return view('admin.printing-types.edit',
            compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PrintingTypeFormRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PrintingTypeFormRequest $request, $id)
    {
        $type = $this->printingTypeRepository->getEdit($id);

        if (empty($type)) {
            return back()
                ->withErrors(['msg' => "Запис з ідентифікатором [{$id}] не знайдено."])
                ->withInput();
        }

        $data = $request->all();

        $result = $type->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('admin.printing-types.edit', $id)
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
