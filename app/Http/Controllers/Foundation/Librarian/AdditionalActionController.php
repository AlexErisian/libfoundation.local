<?php

namespace App\Http\Controllers\Foundation\Librarian;

use App\Repositories\ReadercardRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AdditionalActionController extends BaseController
{
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

        $this->userRepository = app(UserRepository::class);
        $this->readercardRepository = app(ReadercardRepository::class);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function assignReadercardForm()
    {
        return view('librarian.additional-actions.enter_assign');
    }

    public function assignReadercard(Request $request)
    {
        $data = $request->all();

        $user = $this->userRepository->getByEmail($data['user_email']);
        if(empty($user)) {
            return back()
                ->withErrors(['msg' => 'Немає користувача з Email: '.$data['user_email']])
                ->withInput();
        }

        $readercardId = $this->readercardRepository->getIdByCode($data['readercard_code']);
        if(empty($readercardId)) {
            return back()
                ->withErrors(['msg' => 'Немає квитка з таким кодом: '.$data['readercard_code']])
                ->withInput();
        }

        $user->readercard_id = $readercardId;

        $userUpdated = $user->update();
        if($userUpdated) {
            return back()
                ->with(['success' => 'Операція проведена успішно.']);
        } else {
            return back()
                ->withErrors(['msg' => 'Не вдалося зберегти дані.'])
                ->withInput();
        }
    }

    public function checkServicesForm()
    {

    }

    public function servicesList()
    {

    }
}
