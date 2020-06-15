<?php

namespace App\Http\Controllers\Foundation\Reader;

use App\Models\User;
use App\Repositories\LibraryServiceRepository;
use foo\bar;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * @var LibraryServiceRepository
     */
    private $libraryServiceRepository;

    public function __construct()
    {
        parent::__construct();

        $this->libraryServiceRepository = app(LibraryServiceRepository::class);
    }

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $services = $this->libraryServiceRepository
            ->getAllByReadercardId($user->readercard_id);

        return view('reader.users.edit',
            compact('user', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        $user->notes = $data['notes'];

        $userUpdated = $user->update();
        if ($userUpdated) {
            return back()
                ->with(['success' => 'Персональні дані успішно оновлено.']);
        } else {
            return back()
                ->withErrors(['msg' => 'Не вдалося оновити персональні дані.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
