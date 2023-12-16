<?php

namespace App\Interfaces;

interface IInformationRepository
{
    public function all();
    public function create($user_id,array $data);
    public function find($id);
    public function update($id,array $data);
}
