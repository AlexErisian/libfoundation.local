<?php

namespace App\Http\Controllers\Foundation\Reader;

use App\Http\Requests\PrintingCommentFormRequest;
use App\Models\PrintingComment;
use Illuminate\Http\Request;

class PrintingCommentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param PrintingCommentFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(PrintingCommentFormRequest $request)
    {
        $this->authorize('create', PrintingComment::class);

        $data = $request->all();

        $comment = new PrintingComment();
        $comment->fill($data);

        $commentSaved = $comment->save();
        if($commentSaved) {
            return back()
                ->withFragment('comments')
                ->with(['success' => 'Ваш коментар було успішно збережено.']);
        } else {
            return back()
                ->withFragment('comments')
                ->withErrors(['msg' => 'Не вдалося зберегти коментар.']);
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
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $comment = PrintingComment::findOrFail($id);

        $this->authorize('delete', $comment);

        $commentDeleted = $comment->delete();
        if($commentDeleted) {
            return back()
                ->withFragment('comments');
        } else {
            return back()
                ->withFragment('comments')
                ->withErrors(['msg' => 'Не вдалося видалити коментар.']);
        }
    }
}
