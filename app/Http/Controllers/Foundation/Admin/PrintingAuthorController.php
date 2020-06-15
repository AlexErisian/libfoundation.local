<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Http\Requests\PrintingAuthorFormRequest;
use App\Models\PrintingAuthor;
use App\Repositories\PrintingAuthorRepository;

class PrintingAuthorController extends BaseController
{
    /**
     * @var PrintingAuthorRepository
     */
    private $printingAuthorRepository;

    public function __construct()
    {
        parent::__construct();
        $this->printingAuthorRepository = app(PrintingAuthorRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $authorsPagination = $this->printingAuthorRepository
            ->getAllWithPagination(15);
        return view('admin.printing-authors.index',
            compact('authorsPagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.printing-authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PrintingAuthorFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PrintingAuthorFormRequest $request)
    {
        $author = new PrintingAuthor();

        $data = $request->all();

        $result = $author->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('admin.printing-authors.edit', $author->id)
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
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $author = $this->printingAuthorRepository->getEdit($id);
        if(empty($author)) abort(404);
        return view('admin.printing-authors.edit',
            compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PrintingAuthorFormRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PrintingAuthorFormRequest $request, $id)
    {
        $author = $this->printingAuthorRepository->getEdit($id);

        if (empty($author)) {
            return back()
                ->withErrors(['msg' => "Запис з ідентифікатором [{$id}] не знайдено."])
                ->withInput();
        }

        $data = $request->all();

        $result = $author->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('admin.printing-authors.edit', $id)
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
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $author = $this->printingAuthorRepository->getEdit($id);
        $authorDeleted = $author->delete();

        if ($authorDeleted) {
            return redirect()
                ->route('admin.printing-authors.index')
                ->with(['success' => 'Запис успішно вилучено з обліку.']);
        } else {
            return back()
                ->withErrors(['msg' => 'Не вдалося вилучити запис.']);
        }
    }
}
