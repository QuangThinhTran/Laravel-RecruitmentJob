<?php
namespace App\Interfaces;

use App\Constant;
use App\Models\Ticket;

interface ITicketRepository
{
    public function all($action);
    public function createReportUser(array $report);
    public function createReportPost(array $post);
    public function createReportReview(array $review);
    public function createContact(array $contact);
    public function createReview(array $review);
    public function find($id);
    public function delete($id);
    public function update($id);
    public function trashed($id);
    public function replyContact(array $contact);
    public function replyContactEmail(array $contact);
    public function getTicket($action, $status);
    public function getTicketCompany($action, $status);
    public function listReplied($id, $action, $type);
    public function listRepliedTrashed($id, $action, $type);
    public function getTicketByUser($to_user_id, $action);
    public function getTicketReplied($id);
}
