<?php
namespace App\Repositories;

use App\Interfaces\IInformationRepository;
use App\Models\Information;
use App\Trait\Service;

class InformationRepository implements IInformationRepository
{
    use Service;
    public function all()
    {
        return Information::with('type')->get();
    }

    public function create($user_id, array $data)
    {
        $infor = new Information();
        $infor->content = null;
        $infor->user_id = $user_id;
        $infor->type_id = null;
        $infor->save();
        return $infor;
    }

    public function update($user_id, array $data)
    {
        $checkExist = Information::where('user_id', $user_id)->where('type_id', $data['type_id'])->count();

        if ($checkExist > 0) {
            return Information::where('user_id', $user_id)->update([
                'content' => $data['content'],
                'type_id' => $data['type_id'],
            ]);
        }

        $infor = new Information();
        $infor->content = $data['content'];
        $infor->user_id = $user_id;
        $infor->type_id = $data['type_id'];
        $infor->save();
        return $infor;
    }

    public function find($id)
    {
        return Information::with('type')->where('user_id', $id)->get();
    }
}
