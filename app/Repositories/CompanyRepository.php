<?php

namespace App\Repositories;

use App\Constant;
use App\Interfaces\ICompanyRepository;
use App\Models\Company;
use App\Models\Post;

class CompanyRepository implements ICompanyRepository
{
    public function find($id)
    {
        return Company::where('user_id', $id)->first();
    }

    public function storage($id)
    {
        return Company::withTrashed()->find($id);
    }

    public function create($user_id, array $company)
    {
        $data = new Company();
        $data->user_id = $user_id;
        $data->save();
        return $data;
    }

    public function update($id, array $data)
    {
        return Company::where('user_id', $id)->update([
            'staff' => $data['staff'],
            'headquarters' => $data['headquarters'],
            'taxcode' => $data['taxcode'],
            'website' => $data['website'],
        ]);
    }

    public function getPostOutstanding()
    {
        return Post::with('user')
            ->where('status', Constant::STATUS_APPROVED_POST)
            ->select('user_id')
            ->selectRaw('COUNT(*) AS count')
            ->groupBy('user_id')
            ->take(4)
            ->get();
    }
}

