<?php

namespace App\Interfaces;

interface IAdminRepository
{
    public function checkRole($id, $role);
    public function changeStatusPost($id, $user_id, $status);
    public function history($id);
    public function getImageReport();
    public function getImageReportByCondition($action);
    public function getApplied($post_id);
}
