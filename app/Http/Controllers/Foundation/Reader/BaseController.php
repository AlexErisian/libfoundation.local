<?php

namespace App\Http\Controllers\Foundation\Reader;

use App\Http\Controllers\Foundation\BaseController as GuestBaseController;

class BaseController extends GuestBaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }
}
