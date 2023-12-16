<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Interfaces\ICompanyRepository;
use App\Interfaces\IInformationRepository;
use App\Interfaces\ITicketRepository;
use App\Interfaces\ITypeRepository;
use App\Interfaces\IUserRepository;
use App\Repositories\InformationTypeRepository;
use App\Trait\Service;
use Illuminate\Http\Request;

/**
 * @property IUserRepository $user_repo
 * @property ITicketRepository $ticket_repo
 * @property ICompanyRepository $company_repo
 * @property IInformationRepository $information_repo
 * @property ITypeRepository $type_repo
 */
class ReviewController extends Controller
{
    use Service;

    public function __construct
    (
        IUserRepository $userRepository,
        ITicketRepository $ticketRepository,
        ICompanyRepository $companyRepository,
        IInformationRepository $informationRepository,
        InformationTypeRepository $typeRepository,
    ) {
        $this->user_repo = $userRepository;
        $this->ticket_repo = $ticketRepository;
        $this->company_repo = $companyRepository;
        $this->information_repo = $informationRepository;
        $this->type_repo = $typeRepository;
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->ticket_repo->createReview($input);

        return response()->json([
            'result' => true
        ]);
    }

    public function delete(Request $request)
    {
        $input = $request->all();

        try {
            $this->ticket_repo->delete($input['id']);
            $review = $this->ticket_repo->trashed($input['id']);
            $this->ActivityLog('Đã xoá bài nhận xét*' . $review['id'], $input['user_id']);

            return response()->json([
                'result' => false,
                'message' => 'Xoá bài viết thất bại'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
