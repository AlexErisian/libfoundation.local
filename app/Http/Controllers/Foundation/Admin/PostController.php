<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\PostRepository;

class PostController extends BaseController
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    public function __construct()
    {
        parent::__construct();
        $this->postRepository = app(PostRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param PostRepository $repository
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $postsPagination = $this->postRepository
            ->getAllWithPagination(10);
        return view('admin.posts.index',
            compact('postsPagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostStoreRequest $request)
    {
        $result = $this->postRepository->saveModel($request->all());

        if ($result['succeed']) {
            return redirect()
                ->route('admin.posts.edit', $result['id'])
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
        $post = $this->postRepository->getEdit($id);
        if(empty($post)) abort(404);

        return view('admin.posts.edit',
            compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = $this->postRepository->getEdit($id);

        if (empty($post)) {
            return back()
                ->withErrors(['msg' => "Запис з ідентифікатором [{$id}] не знайдено."])
                ->withInput();
        }

        $result = $this->postRepository
            ->updateModel($post, $request->all());

        if ($result) {
            return redirect()
                ->route('admin.posts.edit', $id)
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
