<?php
namespace App\Repositories;

use App\Models\InformationType;
use App\Models\TicketType;
use App\Interfaces\ITypeRepository;


class TicketTypeRepository implements ITypeRepository
{

    public function all()
    {
        return TicketType::orderBy('id','DESC')->paginate(8);
    }

    public function create(array $type)
    {
        $data = new TicketType();
        $data->content = $type['content'];
        $data->save();
        return $data;
    }

    public function find($id)
    {
        return TicketType::find($id)->get();
    }

    public function update($id, array $data)
    {
        return TicketType::find($id)->update([
            'content' => $data['content'],
        ]);
    }

    public function delete($id)
    {
        return TicketType::find($id)->delete();
    }

    public function restore($id)
    {
        return TicketType::onlyTrashed()->find($id)->restore();
    }

    public function trashed($id)
    {
        return InformationType::onlyTrashed()->find($id)->get();
    }
}
