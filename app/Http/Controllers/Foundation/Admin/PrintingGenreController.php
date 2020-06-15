<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Http\Requests\PrintingGenreFormRequest;
use App\Models\PrintingGenre;
use App\Repositories\PrintingGenreRepository;

class PrintingGenreController extends BaseController
{
    /**
     * @var PrintingGenreRepository
     */
    private $printingGenreRepository;

    public function __construct()
    {
        parent::__construct();
        $this->printingGenreRepository = app(PrintingGenreRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $genresPagination = $this->printingGenreRepository
            ->getAllWithPagination(15);
        return view('admin.printing-genres.index',
            compact('genresPagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.printing-genres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PrintingGenreFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PrintingGenreFormRequest $request)
    {
        $genre = new PrintingGenre();

        $data = $request->all();

        $result = $genre->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('admin.printing-genres.edit', $genre->id)
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
        $genre = $this->printingGenreRepository->getEdit($id);
        if(empty($genre)) abort(404);
        return view('admin.printing-genres.edit',
            compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PrintingGenreFormRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PrintingGenreFormRequest $request, $id)
    {
        $genre = $this->printingGenreRepository->getEdit($id);

        if (empty($genre)) {
            return back()
                ->withErrors(['msg' => "Запис з ідентифікатором [{$id}] не знайдено."])
                ->withInput();
        }

        $data = $request->all();

        $result = $genre->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('admin.printing-genres.edit', $id)
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
        $genre = $this->printingGenreRepository->getEdit($id);
        $genreDeleted = $genre->delete();

        if ($genreDeleted) {
            return redirect()
                ->route('admin.printing-genres.index')
                ->with(['success' => 'Запис успішно вилучено з обліку.']);
        } else {
            return back()
                ->withErrors(['msg' => 'Не вдалося вилучити запис.']);
        }
    }
}
