<?php

namespace App\Repositories;

use App\Constant;
use App\Interfaces\ISearchRepository;
use App\Models\Activity;
use App\Models\InformationType;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SearchRepository implements ISearchRepository
{
    public function searchMajorUser($data)
    {
        return User::where('major', $data)->get();
    }

    public function searchInformationType($data)
    {
        return InformationType::where('content', $data)->get();
    }

    public function searchFilter(array $data)
    {
        return Post::with('user')
            ->where('major', $data['major'])
            ->where('working', $data['working'])
            ->where('position', $data['position'])
            ->orderBy('id', 'DESC')
            ->paginate(8);
    }

    public function searchCompanyFilter(array $data)
    {
        return User::where('major', $data['major'])
            ->where('position', $data['position'])
            ->where('role_id', Constant::ROLE_CANDIDATE)
            ->get();
    }

    public function searchDatetimeFilter($from, $to, $user_id)
    {
        return Post::where('status', Constant::STATUS_APPROVED_POST)
            ->where('user_id', $user_id)
            ->where('created_at', '>=' , $from)
            ->where('created_at', '<=', Carbon::parse($to)->endOfDay())
            ->get();
    }

    public function searchUserByRole($role)
    {
        return User::where('role_id', $role)->get();
    }

    public function StatisticalPost($action, $from, $to)
    {
        return Post::where('status', $action)
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)->count();
    }

    public function searchHistoryDatetimeFilter($from, $to)
    {
        return Activity::where('created_at', '>=' , $from)
            ->where('created_at', '<=', Carbon::parse($to)->endOfDay())
            ->get();
    }

    public function searchAjax()
    {
        return Post::with('user')->search()->get();
    }
}
