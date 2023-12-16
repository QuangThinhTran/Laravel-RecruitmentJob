<?php
namespace App\Interfaces;

interface ISearchRepository
{
    public function searchMajorUser($data);
    public function searchInformationType($data);
    public function searchFilter(array $data);
    public function searchCompanyFilter(array $data);
    public function searchDatetimeFilter($from, $to, $user_id);
    public function searchUserByRole($role);
    public function StatisticalPost($action, $from, $to);
    public function searchHistoryDatetimeFilter($from, $to);
    public function searchAjax();
}
