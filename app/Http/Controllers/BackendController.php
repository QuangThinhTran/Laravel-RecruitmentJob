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
use App\Mail\DeletePostMail;
use App\Mail\NotificationDeleteUser;
use App\Mail\NotificationRestoreUser;
use App\Mail\RestorePostMail;
use App\Models\Activity;
use App\Models\Post;
use App\Models\User;
use App\Repositories\InformationTypeRepository;
use App\Repositories\RoleRepository;
use App\Trait\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @property IPostRepository $post_repo
 * @property IUserRepository $user_repo
 * @property IAdminRepository $admin_repo
 * @property ITicketRepository $ticket_repo
 * @property IInformationRepository $information_repo
 * @property ISearchRepository $search_repo
 * @property ICompanyRepository $company_repo
 * @property InformationTypeRepository $infor_type
 */
class BackendController extends Controller
{
    use Service;

    public function __construct
    (
        IUserRepository $userRepository,
        IPostRepository $postRepository,
        IAdminRepository $adminRepository,
        ITicketRepository $ticketRepository,
        IInformationRepository $informationRepository,
        ISearchRepository $searchRepository,
        ICompanyRepository $companyRepository,
        InformationTypeRepository $informationTypeRepository
    ) {
        $this->post_repo = $postRepository;
        $this->user_repo = $userRepository;
        $this->admin_repo = $adminRepository;
        $this->ticket_repo = $ticketRepository;
        $this->information_repo = $informationRepository;
        $this->search_repo = $searchRepository;
        $this->company_repo = $companyRepository;
        $this->infor_type = $informationTypeRepository;
    }

    public function searchFilter(Request $request)
    {
        $input = $request->all();
        $posts = $this->search_repo->searchFilter($input)->toArray();
        $result = array_filter($posts['data'], function ($value) {
            return $value['status'] == Constant::STATUS_APPROVED_POST;
        });
        $test = collect($result);
        return view('user.job.search_result')->with('posts', $test);
    }

    public function searchCompanyFilter(Request $request)
    {
        $input = $request->all();

        $users = $this->search_repo->searchCompanyFilter($input);
        return view('company.search_result')->with([
            'candidates' => $users,
        ]);
    }

    public function searchFilterDatetime(Request $request)
    {
        $input = $request->all();

        $posts = $this->search_repo->searchDatetimeFilter($input['from'], $input['to'], $input['user_id']);
        $all_post = $this->post_repo->getPostByCondition('user_id', Auth::user()->id);
        $post_approved = array_filter($all_post->toArray(), function ($data) {
            return $data['status'] == Constant::STATUS_APPROVED_POST;
        });
        $post_not_approved = array_filter($all_post->toArray(), function ($data) {
            return $data['status'] == Constant::STATUS_NOT_APPROVED_POST;
        });
        return view('company.searchDatetimeResult')->with([
            'all_post' => $posts,
            'count_all_post' => count($all_post),
            'count_post_approved' => count($post_approved),
            'count_post_not_approved' => count($post_not_approved),
        ]);
    }

    public function searchAjax(Request $request)
    {
        $data = $this->search_repo->searchAjax();

        return response()->json([
            'message' => 'Đã tìm thấy ' . $data->count() . ' kết quả',
            'data' => $data,
        ]);
    }

    public function getPostByMajor(Request $request)
    {
        $input = $request->all();

        $posts = $this->post_repo->getMajorByPost(Constant::STATUS_APPROVED_POST, $input['major'],
            Carbon::now()->subMonth(), Carbon::now());
        $company_outstanding = $this->company_repo->getPostOutstanding();

        if ($request->ajax()) {
            return response()->json([
                'posts' => $posts
            ]);
        }

        return view('user.job.post_major')->with([
            'posts' => $posts,
            'company_outstanding' => $company_outstanding
        ]);
    }

    public function searchUser(Request $request)
    {
        $input = $request->all();
        $users = User::where('name', $input['name'])->orWhere('email', $input['email'])->get();

        return view('admin.dashboard.searchUserResult')->with('users', $users);
    }

    public function deletePostMail(Request $request)
    {
        $input = $request->all();
        $post = $this->post_repo->findTrashed($input['id']);
        $this->sendMailUser($post->user, new DeletePostMail(Carbon::now()));
    }

    public function restorePostMail(Request $request)
    {
        $input = $request->all();
        $post = $this->post_repo->find($input['id']);
        $this->sendMailUser($post->user, new RestorePostMail($post->user->name, $post->user->emai, $input['id']));
    }

    public function deleteUserMail(Request $request)
    {
        $input = $request->all();
        $user = $this->user_repo->storage($input['id']);
        $this->sendMailUser($user, new NotificationDeleteUser());
    }

    public function restoreUserMail(Request $request)
    {
        $input = $request->all();
        $user = $this->user_repo->find($input['id']);
        $this->sendMailUser($user, new NotificationRestoreUser($user->name, $user->email));
    }

    public function user(Request $request)
    {
        $input = $request->all();

        $user = $this->user_repo->find($input['id']);
        if (empty($user)) {
            $user = $this->user_repo->storage($input['id']);
        }
        return response()->json([
            'user' => $user
        ]);
    }

    public function post(Request $request)
    {
        $input = $request->all();

        $post = $this->post_repo->find($input['id']);
        if (empty($post)) {
            $post = $this->post_repo->findTrashed($input['id']);
        }
        return response()->json([
            'post' => $post
        ]);
    }

    public function ticket(Request $request)
    {
        $input = $request->all();

        $ticket = $this->ticket_repo->find($input['id']);

        if (empty($ticket)) {
            $ticket = $this->ticket_repo->trashed($input['id']);
            $ticketTrashed = $this->ticket_repo->trashed($ticket->ticket_id);
            if (!empty($ticketTrashed)) {
                $reply_ticket = $this->ticket_repo->listRepliedTrashed($ticketTrashed->id,
                    Constant::TICKET_REPORT_REPLIED,
                    Constant::TICKET_REPORT_POST);
                return response()->json([
                    'ticket' => $ticketTrashed,
                    'reply_ticket' => $reply_ticket
                ]);
            }

            return response()->json([
                'ticket' => $ticket,
                'reply_ticket' => null
            ]);
        }

        $reply_ticket = $this->ticket_repo->listReplied($ticket->id, Constant::TICKET_REPORT_REPLIED,
            Constant::TICKET_REPORT_POST);

        if (empty($reply_ticket)) {
            $ticket = $this->ticket_repo->trashed($input['id']);
            $reply_ticket = $this->ticket_repo->listRepliedTrashed($ticket->id, Constant::TICKET_REPORT_REPLIED,
                Constant::TICKET_REPORT_POST);
        }
        return response()->json([
            'ticket' => $ticket,
            'reply_ticket' => $reply_ticket
        ]);
    }

    public function information(Request $request)
    {
        $input = $request->all();

        $activity = Activity::with('user')->find($input['id']);
        $information = $this->infor_type->find($input['idType']);
        if (empty($information)) {
            $information = $this->infor_type->trashed($input['idType']);
        }

        return response()->json([
            'activity' => $activity,
            'information' => $information
        ]);
    }

    public function searchHistory(Request $request)
    {
        $input = $request->all();

        $history = $this->search_repo->searchHistoryDatetimeFilter($input['from'], $input['to']);
        return view('admin.dashboard.searchDatetimeResultHistory')->with('history', $history);
    }
}
