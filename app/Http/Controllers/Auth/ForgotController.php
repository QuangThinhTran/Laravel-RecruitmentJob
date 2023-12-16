<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPassword;
use App\Interfaces\IUserRepository;
use App\Mail\ForgotPassMail;
use App\Models\User;
use App\Trait\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @property IUserRepository $user_repo
 */
class ForgotController extends Controller
{
    use Service;

    public function __construct
    (
        IUserRepository $userRepository
    ) {
        $this->user_repo = $userRepository;
    }

    public function index()
    {
        return view('auth.forgot');
    }

    public function sendMailForgot(Request $request)
    {
        $input = $request->all();

        $checkExist = User::where('email', $input['email'])->first();
        if (empty($checkExist)) {
            alert()->error('Email không tồn tại');
            return redirect()->route('user.login');
        }
        $this->sendMailUser($input, new ForgotPassMail($input['email']));
        alert()->success('Vui lòng kiểm tra Email để thực hiện thay đổi mật khẩu');
        return redirect()->route('user.login');
    }

    public function forgotPassWord($email)
    {
        return view('auth.resetPassword')->with('email', $email);
    }

    public function handleForgot(ForgetPassword $request)
    {
        $input = $request->all();
        $password = Hash::make($input['password']);
        $user = $this->user_repo->updatePassword($input['email'], $password);
        Auth::login($user);
        alert('Cập nhật mật khẩu thành công', null, 'success');
        return redirect()->route('home');
    }
}
