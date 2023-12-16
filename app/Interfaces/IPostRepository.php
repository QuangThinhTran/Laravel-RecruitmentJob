<?php

namespace App\Interfaces;

interface IPostRepository
{
    public function getPost($action);
    public function all();
    public function create(array $data);
    public function find($id);
    public function update($id,array $data);
    public function delete($id);
    public function findTrashed($id);
    public function trashed();
    public function restore($id);
    public function getMajorByPost($action, $major, $from, $to);
    public function getPostByCondition($condition, $action);
    public function getPostApprovedByDateTime($action, $from, $to);
    public function changeStatus($id, $status);
    public function trashedByUser($user_id);
}
