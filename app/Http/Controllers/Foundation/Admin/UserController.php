<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\ReadercardRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class UserController extends BaseController
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ReadercardRepository
     */
    private $readercardRepository;

    public function __construct()
    {
        parent::__construct();
        $this->roleRepository = app(RoleRepository::class);
        $this->userRepository = app(UserRepository::class);
        $this->readercardRepository = app(ReadercardRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $usersPagination = $this->userRepository
            ->getAllWithPagination(20);
        return view('admin.users.index',
            compact('usersPagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roleOptions = $this->roleRepository
            ->getSelectOptions();
        $readercardOptions = $this->readercardRepository
            ->getSelectOptions();

        return view('admin.users.create',
            compact('roleOptions', 'readercardOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request)
    {
        $result = $this->userRepository->saveModel($request->all());

        if ($result['succeed']) {
            return redirect()
                ->route('admin.users.edit', $result['id'])
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
        $user = $this->userRepository->getEdit($id);
        if (empty($user)) abort(404);

        $roleOptions = $this->roleRepository
            ->getSelectOptions($user->role_id);
        $readercardOptions = $this->readercardRepository
            ->getSelectOptions($user->readercard_id);

        return view('admin.users.edit',
            compact('user', 'roleOptions', 'readercardOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->userRepository->getEdit($id);

        if (empty($user)) {
            return back()
                ->withErrors(['msg' => "Запис з ідентифікатором [{$id}] не знайдено."])
                ->withInput();
        }

        $data = $request->all();
        $result = $user->fill($data)->update();

        if ($result) {
            return redirect()
                ->route('admin.users.edit', $id)
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
