<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Http\Requests\LibraryFormRequest;
use App\Repositories\LibraryRepository;

class LibraryController extends BaseController
{
    /**
     * @property LibraryRepository
     */
    private $libraryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->libraryRepository = app(LibraryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $librariesPagination = $this->libraryRepository
            ->getAllWithPagination(15, false);

        return view('admin.libraries.index',
            compact('librariesPagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.libraries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LibraryFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LibraryFormRequest $request)
    {
        $result = $this->libraryRepository->saveModel($request->all());

        if ($result['succeed']) {
            return redirect()
                ->route('admin.libraries.edit', $result['id'])
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
     * @param LibraryRepository $repository
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $library = $this->libraryRepository->getEdit($id);
        if (empty($library)) abort(404);

        return view('admin.libraries.edit',
            compact('library'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LibraryFormRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LibraryFormRequest $request, $id)
    {
        $library = $this->libraryRepository->getEdit($id);

        if (empty($library)) {
            return back()
                ->withErrors(['msg' => "Запис з ідентифікатором [{$id}] не знайдено."])
                ->withInput();
        }

        $result = $this->libraryRepository
            ->updateModel($library, $request->all());

        if ($result) {
            return redirect()
                ->route('admin.libraries.edit', $id)
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
