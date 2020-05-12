<?php

namespace App\Http\Controllers\Foundation\Admin;

use App\Repositories\PrintingRegistrationRepository;
use Illuminate\Http\Request;

class PrintingRegistrationController extends BaseController
{
    /**
     * @property PrintingRegistrationRepository
     */
    private $registrationRepository;

    public function __construct()
    {
        parent::__construct();
        $this->registrationRepository = app(PrintingRegistrationRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @param PrintingRegistrationRepository $repository
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $registrationsPagination = $this->registrationRepository
            ->getAllWithPagination(15);
        return view('admin.printing-registrations.index',
            compact('registrationsPagination'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $registration = $this->registrationRepository->getEdit($id);
        if (empty($registration)) abort(404);

        return view('admin.printing-registrations.edit',
            compact('registration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $registration = $this->registrationRepository->getEdit($id);

        if (empty($registration)) {
            return back()
                ->withErrors(['msg' => "Запис з ідентифікатором [{$id}] не знайдено."])
                ->withInput();
        }

        $data = $request->all();
        $result = $registration->fill($data)->update();

        if ($result) {
            return redirect()
                ->route('admin.printing-registrations.edit', $id)
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
