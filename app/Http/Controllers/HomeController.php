<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Interfaces\ICompanyRepository;
use App\Interfaces\IPostRepository;
use App\Interfaces\IUserRepository;
use Carbon\Carbon;

/**
 * @property IPostRepository $post_repo
 * @property ICompanyRepository $company_repo
 * @property IUserRepository $user_repo
 */
class HomeController extends Controller
{
    public function __construct
    (
        IPostRepository $postRepository,
        ICompanyRepository $companyRepository,
        IUserRepository $userRepository,
    ) {
        $this->post_repo = $postRepository;
        $this->company_repo = $companyRepository;
        $this->user_repo = $userRepository;
    }

    public function index()
    {
        $posts = $this->post_repo->getPost(Constant::STATUS_APPROVED_POST);
        $companys = $this->user_repo->getUserByCondition('role_id', Constant::ROLE_COMPANY);
        $count_major_IT = $this->post_repo->getMajorByPost(Constant::STATUS_APPROVED_POST, Constant::MAJOR_IT, Carbon::now()->subMonth(), Carbon::now());
        $count_major_accountant = $this->post_repo->getMajorByPost(Constant::STATUS_APPROVED_POST, Constant::MAJOR_ACCOUNTANT, Carbon::now()->subMonth(), Carbon::now());
        $count_major_marketing = $this->post_repo->getMajorByPost(Constant::STATUS_APPROVED_POST, Constant::MAJOR_MARKETING, Carbon::now()->subMonth(), Carbon::now());
        $count_major_manufacturing = $this->post_repo->getMajorByPost(Constant::STATUS_APPROVED_POST, Constant::MAJOR_MANUFACTURING, Carbon::now()->subMonth(), Carbon::now());
        $count_major_electronics = $this->post_repo->getMajorByPost(Constant::STATUS_APPROVED_POST, Constant::MAJOR_ELECTRONICS, Carbon::now()->subMonth(), Carbon::now());
        $count_major_newspapers = $this->post_repo->getMajorByPost(Constant::STATUS_APPROVED_POST, Constant::MAJOR_NEWSPAPERS, Carbon::now()->subMonth(), Carbon::now());
        $count_major_real_estate = $this->post_repo->getMajorByPost(Constant::STATUS_APPROVED_POST, Constant::MAJOR_REAL_ESTATE, Carbon::now()->subMonth(), Carbon::now());
        $count_major_car_technology = $this->post_repo->getMajorByPost(Constant::STATUS_APPROVED_POST, Constant::MAJOR_CAR_TECHNOLOGY, Carbon::now()->subMonth(), Carbon::now());
        $company_outstanding = $this->company_repo->getPostOutstanding();

        return view('layout.index')->with([
            'posts' => $posts,
            'companys' => $companys,
            'count_major_IT' => count($count_major_IT),
            'count_major_accountant' => count($count_major_accountant),
            'count_major_marketing' => count($count_major_marketing),
            'count_major_manufacturing' => count($count_major_manufacturing),
            'count_major_electronics' => count($count_major_electronics),
            'count_major_newspapers' => count($count_major_newspapers),
            'count_major_real_estate' => count($count_major_real_estate),
            'count_major_car_technology' => count($count_major_car_technology),
            'company_outstanding' => $company_outstanding
        ]);
    }

    public function login()
    {
        return view('user.auth.login');
    }

    public function register()
    {
        return view('user.auth.register');
    }

    public function contact()
    {
        return view('layout.contact');
    }

    public function notFound()
    {
        return view('layout.not-found');
    }
}
