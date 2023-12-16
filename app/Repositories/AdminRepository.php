<?php

namespace App\Repositories;

use App\Constant;
use App\Interfaces\IAdminRepository;
use App\Models\Activity;
use App\Models\Applied;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class AdminRepository implements IAdminRepository
{
    public function checkRole($id, $role)
    {
        $admin = User::where('id', $id)->where('role_id', $role)->get();
        if (empty($admin))
        {
            return false;
        }
        return true;
    }
    public function changeStatusPost($id, $user_id, $status)
    {
        return Post::find($id)->update([
            'approved_user_id' => $user_id,
            'status' => $status,
            'approved_date' => Carbon::now()
        ]);
    }

    public function history($id)
    {
        return Activity::with('user')->orderByDesc('id')->get();
    }

    public function getImageReport()
    {
        return Image::with('ticket')->get();
    }

    public function getImageReportByCondition($action)
    {
        return Image::with('ticket')->where('ticket_id', $action)->get();
    }

    public function getApplied($post_id)
    {
        return Applied::with('user', 'post')
            ->where('post_id', $post_id)
            ->get();
    }
}
