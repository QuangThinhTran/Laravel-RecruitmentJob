<?php

namespace App\Console\Commands;

use App\Constant;
use App\Interfaces\IAdminRepository;
use App\Interfaces\IPostRepository;
use App\Interfaces\ISearchRepository;
use App\Interfaces\IUserRepository;
use App\Mail\StatisticalMail;
use App\Mail\WeeeklyMailCandidate;
use App\Mail\WeeklyMailCompany;
use App\Trait\Service;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * @property ISearchRepository $search_repo
 * @property IPostRepository $post_repo
 * @property IUserRepository $user_repo
 */
class StatisticalEmail extends Command
{
    use Service;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:statistical-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail once a week at 9:00 am on Monday';
    private IAdminRepository $admin_repo;

    public function __construct
    (
        ISearchRepository $searchRepository,
        IPostRepository $postRepository,
        IUserRepository $userRepository,
        IAdminRepository $adminRepository
    ) {
        parent::__construct();
        $this->search_repo = $searchRepository;
        $this->post_repo = $postRepository;
        $this->user_repo = $userRepository;
        $this->admin_repo = $adminRepository;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $from = Carbon::now()->startOfWeek()->subWeek()->toDateString();
        $to = Carbon::now()->endOfWeek()->subWeek()->toDateString();

        $post_not_approved = $this->search_repo->StatisticalPost(Constant::STATUS_NOT_APPROVED_POST, $from, $to);
        $post_approved = $this->search_repo->StatisticalPost(Constant::STATUS_APPROVED_POST, $from, $to);

        $this->sendMailByRole(Constant::ROLE_ADMIN,new StatisticalMail($post_not_approved, $post_approved, $from, $to));

        $all_company = $this->user_repo->getUserByCondition('role_id', Constant::ROLE_COMPANY);
        foreach ($all_company as $company)
        {
            $post_by_company = $this->post_repo->getPostByCondition('user_id', $company->id);
            foreach ($post_by_company as $key => $post)
            {
                $users = $this->admin_repo->getApplied($post->id);
                $this->sendMailUser($company, new WeeklyMailCompany($users, $post));
                if ($key >= 2) break;
            }
            break;
        }

        $users = $this->user_repo->getMajorUser(Constant::ROLE_CANDIDATE);

        $data_user = [];
        foreach ($users as $user) {
            $data_user[] = [
                'user' => $user,
                'post' => $this->post_repo->getMajorByPost(Constant::STATUS_APPROVED_POST, $user->major, $from, $to)
            ];
        }

        foreach ($data_user as $data) {
            $this->sendMailUser($data['user'], new WeeeklyMailCandidate($data['user'], $data['post']));
        }
    }
}
