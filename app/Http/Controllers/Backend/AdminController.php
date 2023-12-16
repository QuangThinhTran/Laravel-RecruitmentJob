<?php

namespace App\Http\Controllers\Backend;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\IAdminRepository;
use App\Interfaces\IPostRepository;
use App\Interfaces\ITicketRepository;
use App\Interfaces\IUserRepository;
use App\Mail\NotificationDeleteUser;
use App\Mail\ReplyMail;
use App\Models\Ticket;
use App\Trait\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @property IAdminRepository $admin_repo
 * @property IPostRepository $post_repo
 * @property IUserRepository $user_repo
 * @property ITicketRepository $ticket_repo
 */
class AdminController extends Controller
{
    use Service;

    public function __construct
    (
        IAdminRepository $adminRepository,
        IPostRepository $postRepository,
        IUserRepository $userRepository,
        ITicketRepository $ticketRepository
    ) {
        $this->admin_repo = $adminRepository;
        $this->post_repo = $postRepository;
        $this->user_repo = $userRepository;
        $this->ticket_repo = $ticketRepository;
    }

    public function deletePostByAdmin(Request $request)
    {
        $input = $request->all();

        $this->ActivityLog('Bạn đã xoá bài tuyển dụng%' . $input['id'], $input['user_id']);

        $post = $this->post_repo->delete($input['id']);
        if (empty($post)) {
            return response()->json([
                'result' => true
            ]);
        }
        return response()->json([
            'result' => false
        ]);
    }

    public function deleteUserByAdmin(Request $request)
    {
        $input = $request->all();

        $user = $this->user_repo->find($input['id']);
        $this->ActivityLog("Đã xoá người dùng*" . $user['id'], Auth::user()->id);
        $this->user_repo->delete($input['id']);
        return redirect()->route('dashboard.account');
    }

    public function restoreUserByAdmin(Request $request)
    {
        $input = $request->all();
        $this->user_repo->restore($input['id']);
        $user = $this->user_repo->find($input['id']);
        $this->ActivityLog("Đã khôi phục người dùng*" . $user['id'], Auth::user()->id);

        return redirect()->route('dashboard.account');
    }

    public function approved(Request $request)
    {
        $input = $request->all();
        $this->admin_repo->changeStatusPost($input['id'], Auth::user()->id, Constant::STATUS_APPROVED_POST);
        $this->ActivityLog("Đã phê duyệt bài tuyển dụng*" . $input['id'], Auth::user()->id);

        return redirect()->route('dashboard.index');
    }

    public function repliedContact(Request $request)
    {
        $input = $request->all();

        $input['type_id'] = Constant::TICKET_CONTACT;
        $input['status'] = Constant::TICKET_CONTACT_REPLIED;

        if ($input['to_user_id'] != "null") {
            $this->ticket_repo->update($input['ticket_id']);
            $this->ticket_repo->replyContact($input);
            $this->ActivityLog('Đã phản hồi liên hệ của người dùng*' . $input['ticket_id'], $input['admin_id']);
            alert('Bạn đã phản hồi liên hệ', null, 'success');
            return redirect()->route('dashboard.contact', ['admin_id' => $input['admin_id']]);
        }
        $this->ticket_repo->update($input['ticket_id']);
        $this->sendMailUser($input, new ReplyMail($input['content']));
        $this->ticket_repo->replyContactEmail($input);

        $this->ActivityLog('Đã phản hồi liên hệ của người dùng*' . $input['ticket_id'], $input['admin_id']);
        alert('Bạn đã phản hồi liên hệ', null, 'success');
        return redirect()->route('dashboard.contact', ['admin_id' => $input['admin_id']]);
    }

    public function repliedReport(Request $request)
    {
        $input = $request->all();

        $input['type_id'] = Constant::TICKET_REPORT_POST;
        $this->ticket_repo->update($input['ticket_id']);
        $this->ticket_repo->replyReport($input);

        $this->ActivityLog('Bạn đã phản hồi báo cáo của người dùng*' . $input['ticket_id'], $input['admin_id']);
        alert('Đã phản hồi báo cáo', null, 'success');
        return redirect()->route('dashboard.report', ['admin_id' => $input['admin_id']]);
    }

    public function repliedReportUser(Request $request)
    {
        $input = $request->all();

        $this->ticket_repo->update($input['ticket_id']);
        $input['type_id'] = Constant::TICKET_REPORT_USER;
        $this->ticket_repo->replyReport($input);

        $this->ActivityLog('Đã phản hồi báo cáo của người dùng*' . $input['ticket_id'], $input['admin_id']);
        alert('Bạn đã phản hồi báo cáo', null, 'success');
        return redirect()->route('dashboard.report', ['admin_id' => $input['admin_id']]);
    }

    public function repliedReportReview(Request $request)
    {
        $input = $request->all();

        if (isset($input['deleteReview'])) {
            $this->ticket_repo->delete($input['review_id']);
        } else {
            Ticket::where('id', $input['review_id'])->update([
                'status' => Constant::TICKET_NOT_REPLY
            ]);
        }
        $this->ticket_repo->update($input['ticket_id']);
        $input['type_id'] = Constant::TICKET_REPORT_REVIEW;
        $this->ticket_repo->replyReport($input);

        $this->ActivityLog('Đã phản hồi báo cáo của người dùng*' . $input['ticket_id'], $input['admin_id']);
        alert('Bạn đã phản hồi báo cáo', null, 'success');
        return redirect()->route('dashboard.report', ['admin_id' => $input['admin_id']]);
    }
}
