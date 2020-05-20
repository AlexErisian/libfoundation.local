<?php

namespace App\Http\Controllers\Foundation\Librarian;

use App\Http\Requests\PrintingRegistrationStoreRequest;
use App\Models\Bookshelf;
use App\Models\PrintingRegistration;
use App\Models\PrintingWritingOff;
use App\Repositories\BookshelfRepository;
use App\Repositories\PrintingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationMovementController extends BaseController
{
    /**
     * @var BookshelfRepository
     */
    private $bookshelfRepository;

    /**
     * @var PrintingRepository
     */
    private $printingRepository;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('library');
        $this->printingRepository = app(PrintingRepository::class);
        $this->bookshelfRepository = app(BookshelfRepository::class);
    }

    public function enterTitleOptional()
    {
        return view('librarian.registration.enter_title_optional');
    }

    /**
     * @param Request $request
     */
    public function listOptionsByTitle(Request $request)
    {
        $title = $request->get('printing_title');
        if (empty($title)) {
            return back()
                ->withErrors(['msg' => 'Не введено значення для пошуку.']);
        }

        $printingsPagination = $this->printingRepository->getAllWithTitleLike($title);
        if ($printingsPagination->count() < 1) {
            return back()
                ->with(['not_found' => 'Не знайдено жодного видання за введеною фразою: ' . $title])
                ->withInput();
        }

        return view('librarian.registration.options',
            compact('printingsPagination'));
    }

    public function specifyRegistration($printingId)
    {
        $printing = $this->printingRepository->getEdit($printingId);
        if (empty($printing)) {
            return back()
                ->withErrors(['msg' => 'Не знайдено видання з ідентифікатором ' . $printingId]);
        }

        return view('librarian.registration.specify',
            compact('printing'));
    }

    public function confirmRegistration(PrintingRegistrationStoreRequest $request)
    {
        $data = $request->all();

        $bookshelf = new Bookshelf();
        $registration = new PrintingRegistration();

        $bookshelf->library_id = session('working_library_id');
        $bookshelf->printing_id = $data['printing_id'];
        $bookshelf->exemplars_registered = $data['exemplars_registered_initially'];
        $bookshelf->exemplars_in_stock = $data['exemplars_registered_initially'];
        $bookshelf->shelf_number = $data['shelf_number'] ?? null;
        $bookshelf->shelf_floor = $data['shelf_floor'] ?? null;

        $registration->exemplars_registered_initially = $data['exemplars_registered_initially'];
        $registration->notes = $data['notes'] ?? null;

        DB::beginTransaction();

        $bookshelfSaved = $bookshelf->save();

        $registration->bookshelf_id = $bookshelf->id;
        $registrationSaved = $registration->save();

        if ($bookshelfSaved && $registrationSaved) {
            DB::commit();
            return redirect()
                ->route('librarian.panel')
                ->with(['success' => 'Операція реєстрації проведена успішно.']);
        } else {
            DB::rollBack();
            return back()
                ->withErrors(['msg' => 'Не вдалося провести реєстрацію.'])
                ->withInput();
        }
    }

    public function listWriteOff()
    {
        $bookshelvesPagination = $this->bookshelfRepository
            ->getAllByLibraryId(session('working_library_id'));

        return view('librarian.registration.write_off_options',
            compact('bookshelvesPagination'));
    }

    public function confirmWriteOff($bookshelfId)
    {
        $bookshelf = $this->bookshelfRepository->getEdit($bookshelfId);
        if (empty($bookshelf)) {
            return back()
                ->withErrors(['msg' => 'Не знайдено запис зберігання видання з id = ' . $bookshelfId]);
        }

        $writingOff = new PrintingWritingOff();
        $writingOff->bookshelf_id = $bookshelf->id;
        $writingOff->exemplars_written_off = $bookshelf->exemplars_registered;

        DB::beginTransaction();

        $writingOffSaved = $writingOff->save();
        $bookshelfDeleted = $bookshelf->delete();

        if ($bookshelfDeleted && $writingOffSaved) {
            DB::commit();
            return redirect()
                ->route('librarian.panel')
                ->with(['success' => 'Операція списання проведена успішно.']);
        } else {
            DB::rollBack();
            return back()
                ->withErrors(['msg' => 'Не вдалося провести списання.']);
        }
    }
}
