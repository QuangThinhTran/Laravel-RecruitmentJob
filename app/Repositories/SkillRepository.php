<?php
namespace App\Repositories;

use App\Models\Skill;
use ITypeRepository;

class SkillRepository implements ITypeRepository
{
    public function all()
    {
        return Skill::orderBy('id','DESC')->paginate(8);
    }

    public function create(array $type)
    {
        $data = new Skill();
        $data->content = $type['content'];
        $data->save();
        return $data;
    }

    public function find($id)
    {
        return Skill::find('id')->get();
    }

    public function update($id, array $data)
    {
        $result = Skill::find($id)->update([
            'content' => $data['content'],
        ]);
        return $result;
    }

    public function delete($id)
    {
        return Skill::find($id)->delete();
    }

    public function storage($id)
    {
        // TODO: Implement storage() method.
    }

    public function trashed()
    {
        Skill::onlyTrashed()->get();
    }

    public function restore($id)
    {
        Skill::onlyTrashed()->where('id', $id)->restore();
    }
}
