<?php
namespace App\Repositories;

use App\Constant;
use App\Interfaces\IPostRepository;
use App\Models\Company;
use App\Models\Post;
use Carbon\Carbon;

class PostRepository implements IPostRepository
{
    public function getPost($action)
    {
        return Post::with('user', 'approved_user')->where('status',1)->orderByDesc('id')->paginate(8);
    }

    public function all()
    {
        return Post::with('user')->get();
    }

    public function create(array $data)
    {
        $post = new Post();
        $post->title = $data['title'];
        $post->requirements = $data['requirements'];
        $post->description = $data['description'];
        $post->benefit = $data['benefit'];
        $post->experience = $data['experience'];
        $post->working = $data['working'];
        $post->quantity = $data['quantity'];
        $post->position = $data['position'];
        $post->workplace = $data['workplace'];
        $post->major = $data['major'];
        $post->user_id = $data['user_id'];
        $post->save();
        return Post::where('title', $data['title'])->first();
    }

    public function find($id)
    {
        return Post::with('user')->find($id);
    }
    public function update($id,array $data)
    {
        return Post::find($id)->update([
            'title' => $data['title'],
            'requirements' => $data['requirements'],
            'description' => $data['description'],
            'benefit' => $data['benefit'],
            'quantity' => $data['quantity'],
            'position' => $data['position'],
            'workplace' => $data['workplace'],
            'experience' => $data['experience'],
            'working' => $data['working'],
            'major' => $data['major'],
        ]);
    }
    public function delete($id)
    {
        return Post::find($id)->delete();
    }

    public function findTrashed($id)
    {
        return Post::withTrashed()->with('user','approved_user')->find($id);
    }

    public function trashed()
    {
        return Post::onlyTrashed()->with('user','approved_user')->get();
    }

    public function restore($id)
    {
        return Post::withTrashed()->find($id)->restore();
    }

    public function getMajorByPost($action, $major, $from, $to)
    {
        return Post::with('user')
            ->where('status', $action)
            ->where('major', $major)
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->orderBy('id', 'DESC')
            ->paginate(8);
    }

    public function getPostByCondition($condition, $action)
    {
        return Post::where($condition, $action)->get();
    }

    public function getPostApprovedByDateTime($action, $from, $to)
    {
        return Post::with('user')->with('approved_user')->where('status', $action)
            ->where('approved_date', '>=', $from)
            ->where('approved_date', '<=', $to)
            ->get();
    }

    public function changeStatus($id, $status)
    {
        return Post::find($id)->update([
           'status' => $status
        ]);
    }
    public function trashedByUser($user_id)
    {
        return Post::onlyTrashed()->where('user_id', $user_id)->get();
    }
}
