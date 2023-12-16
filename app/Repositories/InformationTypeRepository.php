<?php
namespace App\Repositories;

use App\Interfaces\ITypeRepository;
use App\Models\InformationType;

class InformationTypeRepository implements ITypeRepository
{

    public function all()
    {
        return InformationType::all();
    }

    public function create(array $type)
    {
        $data = new InformationType();
        $data->content = $type['content'];
        $data->save();
        return $data;
    }

    public function find($id)
    {
        return InformationType::find($id);
    }

    public function update($id, array $data)
    {
        return InformationType::find($id)->update([
            'content' => $data['content'],
        ]);
    }

    public function delete($id)
    {
        return InformationType::find($id)->delete();
    }

    public function restore($id)
    {
        return InformationType::onlyTrashed()->find($id)->restore();
    }

    public function trashed($id)
    {
        return InformationType::onlyTrashed()->find($id);
    }
}
