<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Http\Requests\PrintingCommentFormRequest;
use App\Models\PrintingComment;
use App\Repositories\PrintingCommentRepository;
use App\Repositories\PrintingRepository;
use App\Repositories\UserRepository;

class PrintingCommentController extends BaseController
{
    /**
     * @property PrintingCommentRepository
     */
    private $commentRepository;

    /**
     * @property UserRepository
     */
    private $userRepository;

    /**
     * @property PrintingRepository
     */
    private $printingRepository;

    public function __construct()
    {
        parent::__construct();
        $this->commentRepository = app(PrintingCommentRepository::class);
        $this->userRepository = app(UserRepository::class);
        $this->printingRepository = app(PrintingRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param PrintingCommentRepository $repository
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $commentsPagination = $this->commentRepository
            ->getAllWithPagination(10);

        return view('admin.printing-comments.index',
            compact('commentsPagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $printingOptions = $this->printingRepository
            ->getSelectOptions();
        $userOptions = $this->userRepository
            ->getSelectOptions();

        return view('admin.printing-comments.create',
            compact('printingOptions', 'userOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PrintingCommentFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PrintingCommentFormRequest $request)
    {
        $comment = new PrintingComment();

        $data = $request->all();
        $result = $comment->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('admin.printing-comments.edit', $comment->id)
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
        $comment = $this->commentRepository->getEdit($id);
        if (empty($comment)) abort(404);

        return view('admin.printing-comments.edit',
            compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PrintingCommentFormRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PrintingCommentFormRequest $request, $id)
    {
        $comment = $this->commentRepository->getEdit($id);

        if (empty($comment)) {
            return back()
                ->withErrors(['msg' => "Запис з ідентифікатором [{$id}] не знайдено."])
                ->withInput();
        }

        $data = $request->all();
        $result = $comment->fill($data)->update();

        if ($result) {
            return redirect()
                ->route('admin.printing-comments.edit', $id)
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
        $comment = $this->commentRepository->getEdit($id);
        $commentDeleted = $comment->delete();

        if ($commentDeleted) {
            return redirect()
                ->route('admin.printing-comments.index')
                ->with(['success' => 'Запис успішно вилучено з обліку.']);
        } else {
            return back()
                ->withErrors(['msg' => 'Не вдалося вилучити запис.']);
        }
    }
}
