<?php

namespace App\Http\Controllers\CMS;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequest;
use App\Interfaces\ICompanyRepository;
use App\Interfaces\IInformationRepository;
use App\Interfaces\ITicketRepository;
use App\Interfaces\ITypeRepository;
use App\Interfaces\IUserRepository;
use App\Repositories\InformationTypeRepository;
use App\Trait\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @property IUserRepository $user_repo
 * @property ICompanyRepository $company_repo
 * @property IInformationRepository $information_repo
 * @property ITypeRepository $type_repo
 * @property ITicketRepository $ticket_repo
 */
class ProfileController extends Controller
{
    use Service;

    public function __construct
    (
        IUserRepository $userRepository,
        ICompanyRepository $companyRepository,
        IInformationRepository $informationRepository,
        InformationTypeRepository $typeRepository,
        ITicketRepository $ticketRepository
    ) {
        $this->user_repo = $userRepository;
        $this->company_repo = $companyRepository;
        $this->information_repo = $informationRepository;
        $this->type_repo = $typeRepository;
        $this->ticket_repo = $ticketRepository;
    }

    public function profile($id, Request $request)
    {
        $user = $this->user_repo->find($id);
        $company = $this->company_repo->find($id);
        $information = $this->information_repo->find($id);
        $type = $this->type_repo->all();
        $review = $this->ticket_repo->getTicketByUser($id, Constant::TICKET_REVIEW);
        $admin_replied = $this->ticket_repo->getTicketReplied($id);

        if ($request->ajax()) {
            return response()->json([
                'information' => $information,
                'user' => $user,
                'company' => $company,
                'type_infor' => $type,
                'reviews' => $review,
                'count_review' => count($review)
            ]);
        }

        return view('user.update-infor')
            ->with([
                'user' => $user,
                'company' => $company,
                'information' => $information,
                'type_infor' => $type,
                'admin_replied' => $admin_replied,
                'count_review' => count($review),
                'reviews' => $review
            ]);
    }

    public function handleUpdate(UpdateRequest $request)
    {
        $input = $request->all();

        try {
            $profile = $this->user_repo->update($input['id'], $input);

            if ($request->ajax()) {
                return response()->json([
                    'profile' => $profile
                ]);
            }
            alert()->success('Cập nhật tài khoản thành công');
            if (Auth::user()->role_id == Constant::ROLE_COMPANY) {
                return redirect()->route('company.profile', $input['id']);
            } elseif (Auth::user()->role_id == Constant::ROLE_CANDIDATE) {
                return redirect()->route('profile.index', $input['id']);
            }
            $this->ActivityLog('Đã cập nhật thông tin cá nhân', Auth::user()->id);
            return redirect()->route('dashboard.profile', $input['id']);
        } catch (\Exception $e) {

            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
                'result' => false
            ]);
        }

    }

    public function handleUpdateBasic(Request $request)
    {
        $input = $request->all();

        $input['img_avatar'] = $this->uploadImageAvatar($request);
        $this->user_repo->updateAvatarAndName($input['id'], $input);
        alert()->success('Cập nhật tài khoản thành công');
        if (Auth::user()->role_id == Constant::ROLE_ADMIN) {
            $this->ActivityLog('Đã cập nhật thông tin cá nhân', Auth::user()->id);
            return redirect()->route('dashboard.profile', $input['id']);
        } elseif (Auth::user()->role_id == Constant::ROLE_COMPANY) {
            return redirect()->route('company.profile', $input['id']);
        }

        return redirect()->route('profile.index', $input['id']);
    }

    public function handleUpdateInfor(Request $request)
    {
        $input = $request->all();
        try {
            $input['ticket_reply'] = $input['post_id'] = null;
            $infor = $this->information_repo->update($input['id'], $input);

            if ($request->ajax()) {
                return response()->json([
                    'infor' => $infor
                ]);
            }
            alert()->success('Cập nhật tài khoản thành công');
            if (Auth::user()->role_id == Constant::ROLE_ADMIN) {
                $this->ActivityLog('Đã cập nhật thông tin cá nhân', Auth::user()->id);
                return redirect()->route('dashboard.profile', $input['id']);
            } elseif (Auth::user()->role_id == Constant::ROLE_COMPANY) {
                return redirect()->route('company.profile', $input['id']);
            }
            return redirect()->route('profile.index', $input['id']);
        } catch (\Exception $e) {
            alert()->error('Thông tin đã tồn tại');
            return redirect()->back();
        }
    }

    public function userCompany($id, Request $request)
    {
        $user = $this->user_repo->find($id);
        $information = $this->information_repo->find($id);
        $company = $this->company_repo->find($id);
        $type = $this->type_repo->all();
        $review = $this->ticket_repo->getTicketByUser($id, Constant::TICKET_REVIEW);

        if ($request->ajax()) {
            return response()->json([
                'reviews' => $review,
                'count_review' => count($review),
            ]);
        }

        return view('company.infor')->with([
            'user' => $user,
            'information' => $information,
            'type_infor' => $type,
            'company' => $company,
            'count_review' => count($review),
            'reviews' => $review
        ]);
    }

    public function userProfile($id, Request $request)
    {
        $user = $this->user_repo->find($id);
        $information = $this->information_repo->find($id);
        $company = $this->company_repo->find($id);
        $type = $this->type_repo->all();
        $review = $this->ticket_repo->getTicketByUser($id, Constant::TICKET_REVIEW);
        $admin_replied = $this->ticket_repo->getTicketReplied($id);

        return view('profile.profile')->with([
            'user' => $user,
            'information' => $information,
            'type_infor' => $type,
            'company' => $company,
            'count_review' => count($review),
            'reviews' => $review,
            'admin_replied' => $admin_replied
        ]);
    }

    public function profileCompany($id, Request $request)
    {
        $user = $this->user_repo->find($id);
        $company = $this->company_repo->find($id);
        $information = $this->information_repo->find($id);
        $type = $this->type_repo->all();
        $review = $this->ticket_repo->getTicketByUser($id, Constant::TICKET_REVIEW);

        if ($request->ajax()) {
            return response()->json([
                'information' => $information,
                'user' => $user,
                'company' => $company,
                'reviews' => $review,
                'type_infor' => $type,
                'count_review' => count($review)
            ]);
        }

        return view('company.profile')
            ->with([
                'user' => $user,
                'company' => $company,
                'information' => $information,
                'type_infor' => $type,
                'reviews' => $review,
                'count_review' => count($review),
            ]);
    }
}
