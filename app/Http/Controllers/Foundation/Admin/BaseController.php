<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Http\Controllers\Foundation\BaseController as GuestBaseController;

class BaseController extends GuestBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Show the application admin panel.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    final public function panel()
    {
        return view('admin.panel');
    }
}
