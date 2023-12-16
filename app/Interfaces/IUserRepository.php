<?php
namespace App\Interfaces;

interface IUserRepository
{
    public function all();
    public function create(array $data);
    public function findUserWithEmail($email);
    public function find($id);
    public function update($id,array $data);
    public function updatePassword($email, $password);
    public function updateAvatarAndName($id, array $data);
    public function delete($id);
    public function trashed();
    public function storage($id);
    public function restore($id);
    public function getMajorUser($role);
    public function getUserByRole($role);
    public function getUserByCondition($condition, $value);
    public function getMajorByUser($major, $role);
}
