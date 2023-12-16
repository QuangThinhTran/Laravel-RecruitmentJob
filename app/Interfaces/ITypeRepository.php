<?php

namespace App\Interfaces;

interface ITypeRepository
{
    public function all();
    public function create(array $type);
    public function find($id);
    public function update($id,array $data);
    public function delete($id);
    public function restore($id);
    public function trashed($id);
}
