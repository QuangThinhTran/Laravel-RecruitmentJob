<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Interfaces\IAdminRepository;
use App\Interfaces\ICompanyRepository;
use App\Interfaces\IInformationRepository;
use App\Interfaces\IPostRepository;
use App\Interfaces\ISearchRepository;
use App\Interfaces\ITicketRepository;
use App\Interfaces\IUserRepository;
use App\Repositories\InformationTypeRepository;
use App\Repositories\RoleRepository;
use App\Trait\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @property IPostRepository $post_repo
 * @property IUserRepository $user_repo
 * @property IAdminRepository $admin_repo
 * @property ITicketRepository $ticket_repo
 * @property IInformationRepository $information_repo
 * @property RoleRepository $role_repo
 * @property ISearchRepository $search_repo
 * @property InformationTypeRepository $type_repo
 * @property ICompanyRepository $company_repo
 */
class DashboardController extends Controller
{
    use Service;

    public function __construct
    (
        IUserRepository $userRepository,
        IPostRepository $postRepository,
        IAdminRepository $adminRepository,
        ITicketRepository $ticketRepository,
        IInformationRepository $informationRepository,
        RoleRepository $roleRepository,
        ISearchRepository $searchRepository,
        ICompanyRepository $companyRepository,
        InformationTypeRepository $typeRepository
    ) {
        $this->post_repo = $postRepository;
        $this->user_repo = $userRepository;
        $this->admin_repo = $adminRepository;
        $this->ticket_repo = $ticketRepository;
        $this->information_repo = $informationRepository;
        $this->role_repo = $roleRepository;
        $this->search_repo = $searchRepository;
        $this->company_repo = $companyRepository;
        $this->type_repo = $typeRepository;
    }

    public function index(Request $request)
    {
        $all_post = $this->post_repo->all();
        $post_approved = $this->post_repo->getPostByCondition('status', Constant::STATUS_APPROVED_POST);
        $not_post_approved = $this->post_repo->getPostByCondition('status', Constant::STATUS_NOT_APPROVED_POST);
        $approved_last_week = $this->post_repo->getPostApprovedByDateTime(Constant::STATUS_APPROVED_POST,
            Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek());
        $post_trashed = $this->post_repo->trashed();

        return view('admin.dashboard.dashboard')->with([
            'all_post' => count($all_post),
            'count_post_approved' => count($post_approved),
            'count_not_post_approved' => count($not_post_approved),
            'count_post_trashed' => count($post_trashed),
            'approved_last_week' => $approved_last_week,
            'post_not_approved' => $not_post_approved,
            'post_trashed' => $post_trashed,
        ]);
    }

    public function account(Request $request)
    {
        $all_user = $this->user_repo->all();
        $user_admin = $this->user_repo->getUserByCondition('role_id', Constant::ROLE_ADMIN);
        $user_company = $this->user_repo->getUserByCondition('role_id', Constant::ROLE_COMPANY);
        $user_candidate = $this->user_repo->getUserByCondition('role_id', Constant::ROLE_CANDIDATE);
        $user_trashed = $this->user_repo->trashed();

        return view('admin.dashboard.account')->with([
            'all_user' => count($all_user),
            'count_user_admin' => count($user_admin),
            'count_user_company' => count($user_company),
            'count_user_candidate' => count($user_candidate),
            'user_admin' => $user_admin,
            'user_company' => $user_company,
            'user_candidate' => $user_candidate,
            'user_trashed' => $user_trashed
        ]);
    }

    public function profile($id, Request $request)
    {
        $user = $this->user_repo->find($id);
        $company = $this->company_repo->find($id);
        $information = $this->information_repo->find($id);
        $type = $this->type_repo->all();
        if ($request->ajax()) {
            return response()->json([
                'information' => $information,
                'user' => $user,
                'company' => $company,
            ]);
        }

        return view('admin.dashboard.profile')
            ->with([
                'user' => $user,
                'company' => $company,
                'information' => $information,
                'type_infor' => $type,
            ]);
    }

    public function profileUser($id)
    {
        $user = $this->user_repo->find($id);
        $company = $this->company_repo->find($id);
        if (empty($user)) {
            $user = $this->user_repo->storage($id);
            $company = $this->company_repo->storage($id);
            return view('admin.infor')
                ->with([
                    'user' => $user,
                    'company' => $company
                ]);
        }
        return view('admin.infor')
            ->with([
                'user' => $user,
                'company' => $company
            ]);
    }

    public function contact(Request $request)
    {
        $contact_not_reply = $this->ticket_repo->getTicket(Constant::TICKET_CONTACT, Constant::TICKET_NOT_REPLY);
        $contact_reply = $this->ticket_repo->getTicket(Constant::TICKET_CONTACT, Constant::TICKET_REPLIED);

        return view('admin.dashboard.contact')->with([
            'count_contact' => count($contact_not_reply) + count($contact_reply),
            'count_contact_not_reply' => count($contact_not_reply),
            'count_contact_reply' => count($contact_reply),
            'contact_not_reply' => $contact_not_reply,
            'contact_reply' => $contact_reply,
        ]);
    }

    public function report()
    {
        $report_post_not_reply = $this->ticket_repo->getTicket(Constant::TICKET_REPORT_POST,
            Constant::TICKET_NOT_REPLY);
        $report_user_not_reply = $this->ticket_repo->getTicket(Constant::TICKET_REPORT_USER,
            Constant::TICKET_NOT_REPLY);
        $report_ticket_not_reply = $this->ticket_repo->getTicket(Constant::TICKET_REPORT_REVIEW,
            Constant::TICKET_NOT_REPLY);

        $report_post_replied = $this->ticket_repo->getTicket(Constant::TICKET_REPORT_POST,
            Constant::TICKET_REPLIED);
        $report_user_replied = $this->ticket_repo->getTicket(Constant::TICKET_REPORT_USER,
            Constant::TICKET_REPLIED);
        $report_ticket_replied = $this->ticket_repo->getTicket(Constant::TICKET_REPORT_REVIEW,
            Constant::TICKET_REPLIED);

        $report_post_reply = $this->ticket_repo->getTicket(Constant::TICKET_REPORT_POST,
            Constant::TICKET_REPORT_REPLIED);
        $report_user_reply = $this->ticket_repo->getTicket(Constant::TICKET_REPORT_USER,
            Constant::TICKET_REPORT_REPLIED);
        $report_ticket_reply = $this->ticket_repo->getTicket(Constant::TICKET_REPORT_REVIEW,
            Constant::TICKET_REPORT_REPLIED);

        $image_report = $this->admin_repo->getImageReport();

        return view('admin.dashboard.report')->with([
            'count_report_post' => count($report_post_not_reply),
            'count_report_user' => count($report_user_not_reply),
            'count_report_not_reply' => count($report_post_not_reply) + count($report_user_not_reply),
            'count_report_reply' => count($report_post_reply) + count($report_user_reply),
            'report_post_not_reply' => $report_post_not_reply,
            'report_user_not_reply' => $report_user_not_reply,
            'report_ticket_not_reply' => $report_ticket_not_reply,
            'report_post_reply' => $report_post_reply,
            'report_user_reply' => $report_user_reply,
            'report_ticket_reply' => $report_ticket_reply,
            'report_post_replied' => $report_post_replied,
            'report_user_replied' => $report_user_replied,
            'report_ticket_replied' => $report_ticket_replied,
            'images' => $image_report
        ]);
    }

    public function information(Request $request)
    {
        $type = $this->type_repo->all();

        if ($request->ajax()) {
            return response()->json([
                'data' => $type
            ]);
        }

        return view('admin.dashboard.type')->with([
            'data' => $type
        ]);
    }

    public function history(Request $request)
    {
        $input = $request->all();

        $history = $this->admin_repo->history($input['id']);
        return view('admin.dashboard.history')->with('history', $history);
    }

    public function register()
    {
        return view('admin.dashboard.register');
    }
}
