<?php

namespace App\Http\Controllers\Foundation\Librarian;

use App\Http\Controllers\Foundation\BaseController as GuestBaseController;
use App\Models\Library;
use App\Repositories\LibraryRepository;
use Illuminate\Http\Request;

class BaseController extends GuestBaseController
{
    /**
     * @var LibraryRepository
     */
    private $libraryRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:librarian');

        $this->libraryRepository = app(LibraryRepository::class);
    }

    /**
     * Show the application librarian panel.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    final public function panel()
    {
        if (session()->exists([
            'working_library_id',
            'working_library_name',
        ])) {
            return view('librarian.panel');
        } else {
            $libraryOptions = $this->libraryRepository->getSelectOptions();

            return view('librarian.panel',
                compact('libraryOptions'));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    final public function setWorkingLibrary(Request $request)
    {
        $data = $request->all();
        $library = Library::findOrFail($data['library_id'], ['id', 'name']);

        session([
            'working_library_id' => $library->id,
            'working_library_name' => $library->name,
        ]);

        return redirect()->route('librarian.panel');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    final public function unsetWorkingLibrary()
    {
        session()->forget([
            'working_library_id',
            'working_library_name',
        ]);

        return redirect()->route('librarian.panel');
    }
}
