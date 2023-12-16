<?php

namespace App\Http\Controllers\Backend;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Interfaces\ICompanyRepository;
use App\Interfaces\IUserRepository;
use App\Trait\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * @property IUserRepository $user_repo
 * @property ICompanyRepository $company_repo
 */
class UserController extends Controller
{
    use Service;

    public function __construct
    (
        IUserRepository $userRepository,
        ICompanyRepository $companyRepository
    ) {
        $this->user_repo = $userRepository;
        $this->company_repo = $companyRepository;
    }

    public function applied(Request $request)
    {
        $input = $request->all();

        $data = $this->appliedPost($input['user_id'], $input['post_id']);
        if (!$data) {
            return response()->json([
                'result' => $data
            ]);
        }
        return redirect()->route('post.detail', $input['post_id']);
    }

    public function unApplied(Request $request)
    {
        $input = $request->all();

        $this->unAppliedPost($input['user_id'], $input['post_id']);

        return redirect()->route('post.detail', $input['post_id']);
    }

    public function logout()
    {
        if (Auth::user()->role_id == Constant::ROLE_ADMIN) {
            $this->ActivityLog('Đã đăng xuất', Auth::user()->id);
        }
        Auth::logout();
        return redirect()->route('home');
    }
}
