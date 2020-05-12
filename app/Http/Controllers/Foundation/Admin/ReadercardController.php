<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Http\Requests\ReadercardFormRequest;
use App\Models\Readercard;
use App\Repositories\ReadercardRepository;

class ReadercardController extends BaseController
{
    /**
     * @var ReadercardRepository
     */
    private $readercardRepository;

    public function __construct()
    {
        parent::__construct();
        $this->readercardRepository = app(ReadercardRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $readercardsPagination = $this->readercardRepository
            ->getAllWithPagination(15);
        return view('admin.readercards.index',
            compact('readercardsPagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.readercards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReadercardFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReadercardFormRequest $request)
    {
        $readercard = new Readercard();

        $data = $request->all();

        $result = $readercard->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('admin.readercards.edit', $readercard->id)
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
        $readercard = $this->readercardRepository->getEdit($id);
        if(empty($readercard)) abort(404);

        return view('admin.readercards.edit',
            compact('readercard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReadercardFormRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReadercardFormRequest $request, $id)
    {
        $readercard = $this->readercardRepository->getEdit($id);

        if (empty($readercard)) {
            return back()
                ->withErrors(['msg' => "Запис з ідентифікатором [{$id}] не знайдено."])
                ->withInput();
        }

        $data = $request->all();

        $result = $readercard->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('admin.readercards.edit', $id)
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
