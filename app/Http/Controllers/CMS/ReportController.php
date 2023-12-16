<?php

namespace App\Http\Controllers\CMS;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Interfaces\IAdminRepository;
use App\Interfaces\ITicketRepository;
use App\Mail\ReplyMail;
use App\Models\Ticket;
use App\Trait\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * @property ITicketRepository $ticket_repo
 * @property IAdminRepository $admin_repo
 */
class ReportController extends Controller
{
    use Service;
    public function __construct
    (
        ITicketRepository $ticketRepository,
        IAdminRepository $adminRepository
    )
    {
        $this->ticket_repo = $ticketRepository;
        $this->admin_repo = $adminRepository;
    }

    public function index()
    {
//        $report = $this->ticket_repo->all(Constant::TICKET_REPORT);
//        return response()->json([
//            'data' => $report
//        ]);
    }
    public function show(Request $request)
    {
        $input = $request->all();

        $report= $this->ticket_repo->find($input['id']);

        return response()->json([
            'data' => $report,
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $report = $this->ticket_repo->createReportPost($input);

        if ($files = $request->file('image')) {
            foreach ($files as $file) {
                $fileName =  Str::random(6) .".jpg";
                $file->move('Images', $fileName, 'public');
                $this->saveImageReport($fileName, $report['id']);
            }
        }

        alert('Đã gửi thành công', null, 'success');
        return redirect()->route('post.detail', ['id' => $input['post_id']]);
    }

    public function user(Request $request)
    {
        $input = $request->all();

        $report = $this->ticket_repo->createReportUser($input);

        if ($files = $request->file('image')) {
            foreach ($files as $file) {
                $fileName = Str::random(6) . ".jpg";
                $file->move('Images', $fileName, 'public');
                $this->saveImageReport($fileName, $report['id']);
            }
        }
        Ticket::where('id', $report->ticket_id)->update([
            'status' => Constant::TICKET_WAITING_REPORT
        ]);
        alert('Đã gửi thành công', null, 'success');
        if ($input['role_id'] == Constant::ROLE_COMPANY)
        {
            return redirect()->route('profile.user',['id' => $input['user_id']]);
        }
        elseif ($input['role_id'] == Constant::ROLE_CANDIDATE)
        {
            return redirect()->route('profile.user',['id' => $input['user_id']]);
        }
        return redirect()->route('post.detail', ['id' => $input['post_id']]);
    }

    public function review(Request $request)
    {
        $input = $request->all();

        $report = $this->ticket_repo->createReportReview($input);

        if ($files = $request->file('image')) {
            foreach ($files as $file) {
                $fileName = Str::random(6) . ".jpg";
                $file->move('Images', $fileName, 'public');
                $this->saveImageReport($fileName, $report['id']);
            }
        }

        Ticket::where('id', $report->ticket_id)->update([
            'status' => Constant::TICKET_WAITING_REPORT
        ]);
        alert('Đã gửi thành công', null, 'success');
        if ($input['role_id'] == Constant::ROLE_COMPANY)
        {
            return redirect()->route('company.review');
        }
        elseif ($input['role_id'] == Constant::ROLE_CANDIDATE)
        {
            return redirect()->route('profile.user.detail',['id' => $input['user_id']]);
        }
        return redirect()->route('post.detail', ['id' => $input['post_id']]);
    }

    public function delete(Request $request)
    {
        $input = $request->all();

        $this->ticket_repo->delete($input['id']);
        if (Auth::user()->role_id == Constant::ROLE_COMPANY)
        {
            return response()->json([
                'result' => true
            ]);
        }
        elseif (Auth::user()->role_id == Constant::ROLE_CANDIDATE)
        {
            return response()->json([
                'result' => true
            ]);
        }
        else
        {
            toast()->success('Đã xoá thành công');
            $this->ActivityLog('Đã xoá bản báo cáo bài viết*' . $input['id'], Auth::user()->id);
            return redirect()->route('dashboard.report');
        }
    }

    public function reply(Request $request)
    {
        $input = $request->all();

        $this->ticket_repo->reply($input['id']);
        $this->ActivityLog('Đã phản hồi bản báo cáo bài viết*', $input['admin_id']);

        return response()->json([
            'result' => true
        ]);
    }

    public function replied(Request $request)
    {
        $input = $request->all();

        $report_post = $this->ticket_repo->listReplied($input['id'],Constant::TICKET_REPORT_REPLIED ,Constant::TICKET_REPORT_POST);
        $report_user = $this->ticket_repo->listReplied($input['id'],Constant::TICKET_REPORT_REPLIED ,Constant::TICKET_REPORT_USER);
        $report_review = $this->ticket_repo->listReplied($input['id'],Constant::TICKET_REPORT_REPLIED ,Constant::TICKET_REPORT_REVIEW);
        return response()->json([
            'data' => $report_post,
            'result' => $report_user,
            'value' => $report_review
        ]);
    }

    public function image(Request $request)
    {
        $input = $request->all();
        $images = $this->admin_repo->getImageReportByCondition($input['id']);

        return response()->json([
            'images' => $images,
        ]);
    }

    public function detail(Request $request)
    {
        $input = $request->all();

        $report = $this->ticket_repo->find($input['id']);

        $detail_report = $this->ticket_repo->find($report->ticket_id);

        return response()->json([
            'data' => $detail_report,
        ]);
    }
}
