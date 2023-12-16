<?php

namespace App\Repositories;

use App\Constant;
use App\Interfaces\ITicketRepository;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class TicketRepository implements ITicketRepository
{

    public function all($action)
    {
        return Ticket::with('user')->where('type_id', $action)->orderBy('id', 'DESC')->get();
    }

    public function createReportUser(array $report)
    {
        $data = new Ticket();
        $data->content = $report['content'];
        $data->type_id = Constant::TICKET_REPORT_USER;
        $data->from_user_id = is_null(Auth::user()->id) ?: Auth::user()->id;
        $data->to_user_id = $report['to_user_id'];
        $data->ticket_id = $report['ticket_id'];
        $data->save();
        return $data;
    }

    public function createReportPost(array $post)
    {
        $data = new Ticket();
        $data->content = $post['content'];
        $data->type_id = Constant::TICKET_REPORT_POST;
        $data->post_id = $post['post_id'];
        $data->from_user_id = is_null(Auth::user()->id) ?: Auth::user()->id;
        $data->save();
        return $data;

    }

    public function createReportReview(array $review)
    {
        $data = new Ticket();
        $data->content = $review['content'];
        $data->type_id = Constant::TICKET_REPORT_REVIEW;
        $data->ticket_id = $review['ticket_id'];
        $data->from_user_id = is_null(Auth::user()->id) ?: Auth::user()->id;
        $data->save();
        return $data;

    }

    public function createContact(array $contact)
    {
        $data = new Ticket();
        $data->username = $contact['username'];
        $data->email = $contact['email'];
        $data->content = $contact['content'];
        $data->type_id = Constant::TICKET_CONTACT;
        $data->from_user_id = isset(Auth::user()->id) ? Auth::user()->id : null;
        $data->save();
        return $data;
    }

    public function createReview(array $review)
    {
        $data = new Ticket();
        $data->content = $review['content'];
        $data->type_id = Constant::TICKET_REVIEW;
        $data->from_user_id = is_null(Auth::user()->id) ?: Auth::user()->id;
        $data->to_user_id = $review['to_user_id'];
        $data->save();
        return $data;
    }

    public function find($id)
    {
        return Ticket::with('to_user', 'from_user', 'type')->find($id);
    }

    public function delete($id)
    {
        return Ticket::find($id)->delete();
    }

    public function update($id)
    {
        return Ticket::where('id', $id)->update([
            'status' => Constant::TICKET_REPLIED
        ]);
    }

    public function trashed($id)
    {
        return Ticket::withTrashed()->with('to_user', 'from_user', 'type')->find($id);
    }

    public function replyContact(array $contact)
    {
        $data = new Ticket();
        $data->ticket_id = $contact['ticket_id'];
        $data->content = $contact['content'];
        $data->type_id = Constant::TICKET_CONTACT;
        $data->status = Constant::TICKET_CONTACT_REPLIED;
        $data->from_user_id = is_null(Auth::user()->id) ?: Auth::user()->id;
        $data->to_user_id = $contact['to_user_id'];
        $data->save();
        return $data;
    }

    public function replyContactEmail(array $contact)
    {
        $data = new Ticket();
        $data->ticket_id = $contact['ticket_id'];
        $data->content = $contact['content'];
        $data->type_id = Constant::TICKET_CONTACT;
        $data->status = Constant::TICKET_CONTACT_REPLIED;
        $data->from_user_id = is_null(Auth::user()->id) ?: Auth::user()->id;
        $data->save();
        return $data;
    }

    public function replyReport(array $report)
    {
        $data = new Ticket();
        $data->ticket_id = $report['ticket_id'];
        $data->content = $report['content'];
        $data->type_id = $report['type_id'];
        $data->status = Constant::TICKET_REPORT_REPLIED;
        $data->from_user_id = is_null(Auth::user()->id) ?: Auth::user()->id;
        $data->to_user_id = $report['to_user_id'];
        $data->save();
        return $data;
    }

//    public function getTicket($action, $status)
//    {
//        return Ticket::with('from_user', 'image')
//            ->where('type_id', $action)
//            ->where('status', $status)
//            ->orWhere('status','=',Constant::TICKET_WAITING_REPORT)
//            ->orderByDesc('id')
//            ->get();
//    }

    public function getTicket($action, $status)
    {
        return Ticket::with('from_user', 'image', 'to_user')
            ->where('type_id', $action)
            ->where('status', $status)
            ->orderByDesc('id')
            ->get();
    }

    public function getTicketCompany($action, $status)
    {
        return Ticket::with('from_user', 'image')
            ->where('type_id', $action)
            ->where('status', $status)
            ->where('to_user_id', Auth::user()->id)
            ->orderByDesc('id')
            ->get();
    }

    public function listReplied($id, $action, $type)
    {
        return Ticket::with('from_user')
            ->where('ticket_id', $id)
            ->where('status', $action)
            ->where('type_id', $type)
            ->first();
    }

    public function listRepliedTrashed($id, $action, $type)
    {
        return Ticket::withTrashed()
            ->with('from_user')
            ->where('ticket_id', $id)
            ->first();
    }

    public function getTicketByUser($to_user_id, $action)
    {
        return Ticket::with('from_user')
            ->where('to_user_id', $to_user_id)
            ->where('type_id', $action)
            ->where('status', '<>', Constant::TICKET_WAITING_REPORT)
            ->get();
    }

    public function getTicketReplied($id)
    {
        return Ticket::with('from_user')
            ->where('to_user_id', $id)
            ->where('status', '<>', Constant::TICKET_NOT_REPLY)
            ->where('status', '<>', Constant::TICKET_WAITING_REPORT)
            ->get();
    }
}
