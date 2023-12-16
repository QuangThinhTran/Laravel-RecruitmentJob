<?php

namespace App\Interfaces;

interface ICompanyRepository
{
    public function find($id);
    public function storage($id);
    public function create($user_id,array $company);
    public function update($id,array $data);
    public function getPostOutstanding();
}
