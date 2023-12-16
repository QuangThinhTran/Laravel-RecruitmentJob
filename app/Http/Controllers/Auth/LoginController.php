<?php

namespace App\Http\Controllers\Auth;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Mail\NotificationDeleteUser;
use App\Trait\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    use Service;
    public function index()
    {
        return view('auth.login');
    }

    public function handleLogin(LoginRequest $request)
    {
        $input = $request->all();
        $user = [
            'username' => $input['username'],
            'password' => $input['password'],
            'role_id' => Constant::ROLE_CANDIDATE
        ];

        $company = [
            'username' => $input['username'],
            'password' => $input['password'],
            'role_id' => Constant::ROLE_COMPANY
        ];

        $admin = [
            'username' => $input['username'],
            'password' => $input['password'],
            'role_id' => Constant::ROLE_ADMIN
        ];

        if (Auth::attempt($user, $input['remember_token']))
        {
            return redirect()->route('home');
        }
        elseif (Auth::attempt($company, $input['remember_token']))
        {
            return redirect()->route('company.index');
        }
        elseif (Auth::attempt($admin, $input['remember_token']))
        {
            $user = $this->user_repo->getUserByCondition('username', $input['username']);
            $this->ActivityLog('Đã đăng nhập', $user[0]->id);
            return redirect()->route('dashboard.index');
        }
        else {
            return redirect()->back()->with('Error', 'Đăng nhập thất bại');
        }
    }
}
