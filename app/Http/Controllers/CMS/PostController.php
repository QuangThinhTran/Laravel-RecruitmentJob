<?php

namespace App\Http\Controllers\CMS;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Interfaces\IAdminRepository;
use App\Interfaces\IInformationRepository;
use App\Interfaces\IPostRepository;
use App\Interfaces\IUserRepository;
use App\Mail\DeletePostMail;
use App\Trait\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @property IPostRepository $post_repo
 * @property IInformationRepository $infor_repo
 * @property IAdminRepository $admin_repo
 * @property IUserRepository $user_repo
 */
class PostController extends Controller
{
    use Service;
    public function __construct
    (
        IPostRepository $postRepository,
        IInformationRepository $informationRepository,
        IAdminRepository $adminRepository,
        IUserRepository $userRepository,
    )
    {
        $this->post_repo = $postRepository;
        $this->infor_repo = $informationRepository;
        $this->admin_repo = $adminRepository;
        $this->user_repo = $userRepository;
    }

    public function all(Request $request)
    {
        $post_approved = $this->post_repo->all();
        $post_not_approved = $this->post_repo->all();

        if ($request->ajax())
        {
            return  response()->json([
                'message_approved' => 'Có tất cả ' . count($post_approved) . ' bài viết được phê duyệt',
                'message_not_approved' => 'Có tất cả ' . count($post_not_approved) . ' bài viết chưa được phê duyệt',
                'approved' => $post_approved,
                'not_approved' => $post_not_approved
            ]);
        }

        return view('user.job.post');
    }

    public function show($id, Request $request)
    {
        $from = Carbon::now()->startOfWeek()->subWeek()->toDateString();
        $to = Carbon::now()->endOfWeek()->subWeek()->toDateString();
        $post = $this->post_repo->find($id);
        $post_majors = $this->post_repo->getMajorByPost(Constant::STATUS_APPROVED_POST, $post->major, $from, $to);

        if ($request->ajax()) {
            return response()->json([
                'post' => $post,
                'post_majors' => $post_majors,
            ]);
        }

        return view('user.job.detail',[
            'post' => $post,
            'post_majors' => $post_majors,
            'auth' => is_null(Auth::user()) ? null : Auth::user()->id
        ]);
    }

    public function store(PostRequest $request)
    {
        $input = $request->all();

        $post = $this->post_repo->create($input);
        if(empty($post))
        {
            return redirect()->back()->with('Error','Lỗi tạo bài viết');
        }

        return redirect()->route('company.index');
    }

    public function update(PostRequest $request)
    {
        $input = $request->all();
        $this->post_repo->update($input['id'], $input);
        toast()->success('Cập nhật bài viết thành công');
        return redirect()->route('company.index');
    }

    public function edit(Request $request)
    {
        $input = $request->all();

        $post = $this->post_repo->find($input['id']);
        return view('company.edit')->with('post', $post);
    }

    public function delete(Request $request)
    {
        $input = $request->all();

        if (Auth::user()->role_id == Constant::ROLE_ADMIN)
        {
            $this->post_repo->delete($input['id']);
            $this->ActivityLog(  "Đã xoá bài tuyển dụng*" . $input['id'], Auth::user()->id);
            return redirect()->route('dashboard.index');
        }
        $this->post_repo->delete($input['id']);
        return redirect()->route('company.index');
    }

    public function trashed(Request $request)
    {
        $input = $request->all();

        $post = $this->post_repo->findTrashed($input['id']);

        if ($request->ajax())
        {
            return response()->json([
                'post' => $post
            ]);
        }
    }

    public function restore(Request $request)
    {
        $input = $request->all();

        $this->post_repo->restore($input['id']);

        if (Auth::user()->role_id == Constant::ROLE_ADMIN)
        {
            $this->ActivityLog(  "Đã khôi phục bài tuyển dụng*" . $input['id'] , Auth::user()->id);
        }

        return response()->json([
            'result' => true
        ]);
    }

    public function status(Request $request)
    {
        $input = $request->all();
        $this->post_repo->changeStatus($input['id'], $input['status']);
        return response()->json([
            'result' => true
        ]);
    }
}
