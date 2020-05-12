<?php

namespace App\Http\Controllers\Foundation\Admin;

class PrintingGenreLinkController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $linksPagination = \DB::table('printing_genre')
            ->paginate(15);
        return view('admin.printing-genre-links.index',
            compact('linksPagination'));
    }
}
