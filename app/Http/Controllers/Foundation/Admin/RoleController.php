<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Repositories\RoleRepository;

class RoleController extends BaseController
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct()
    {
        parent::__construct();
        $this->roleRepository = app(RoleRepository::class);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = $this->roleRepository->getListing();
        return view('admin.roles.index', compact('roles'));
    }
}
