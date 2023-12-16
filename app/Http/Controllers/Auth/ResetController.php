<?php

namespace App\Http\Controllers\Auth;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Interfaces\IUserRepository;
use App\Trait\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @property IUserRepository $user_repo
 */
class ResetController extends Controller
{
    use Service;

    public function __construct
    (
        IUserRepository $userRepository
    ) {
        $this->user_repo = $userRepository;
    }

    public function updatePassword(PasswordRequest $request)
    {
        $input = $request->all();
        $profile = $this->user_repo->find($input['id']);

        if ($input['password_old'] != null && $input['password'] == $input['password_confirmation']) {
            //Kiểm tra Mật khẩu cũ có giống với mật khẩu đã đăng ký
            if (Hash::check($input['password_old'], $profile['password'])) {
                $profile['password'] = Hash::make($input['password']);
                $profile->save();
                alert()->success('Cập nhật tài khoản thành công');
                if (Auth::user()->role_id == Constant::ROLE_ADMIN) {
                    $this->ActivityLog('Đã thay đổi mật khẩu', Auth::user()->id);
                    return redirect()->route('dashboard.profile', $input['id']);
                }
                elseif (Auth::user()->role_id == Constant::ROLE_COMPANY) {
                    return redirect()->route('company.profile', $input['id']);
                }
                return redirect()->route('profile.index', ['id' => $input['id']]);
            }
            else {
                return redirect()->back()->with("Error", "Xác nhận mật khẩu không chính xác");
            }
        }
        return redirect()->route('home');
    }
}
