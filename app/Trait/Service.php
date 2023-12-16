<?php

namespace App\Trait;

use App\Constant;
use App\Interfaces\IUserRepository;
use App\Models\Activity;
use App\Models\Applied;
use App\Models\Image;
use App\Models\Information;
use App\Models\InformationType;
use App\Models\Role;
use App\Models\TicketType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

trait Service
{
    public function __construct
    (
        IUserRepository $userRepository,
    ) {
        $this->user_repo = $userRepository;
    }

    public function uploadImage(Request $request)
    {
        $data['image'] = $request->image;
        $nameImage = Str::random(6);
        if ($request->has("image") != null) {
            $fileName = "{$nameImage}.jpg";
            $request->file('image')->storeAs('image_avatar', $fileName, 'public');
            $data['image'] = "$fileName";
            return $data['image'];
        }
    }

    public function uploadImageAvatar(Request $request)
    {
        $data['image'] = $request->img_avatar;
        $nameImage = Str::random(6);
        if ($request->has("img_avatar") != null) {
            $fileName = "{$nameImage}.jpg";
            $request->file('img_avatar')->storeAs('image_avatar', $fileName, 'public');
            $data['image'] = "$fileName";
            return $data['image'];
        }
    }

    public function sendMailUser($user, $mailable)
    {
        if ($this->isValidMail($user['email'])) {
            Mail::to($user['email'])->send($mailable);
        }
    }

    public function sendMailByRole($role, $mailable)
    {
        $users = $this->user_repo->getUserByRole($role);
        foreach ($users as $user) {
            if (self::isValidMail($user->email)) {
                Mail::to($user->email)->send($mailable);
            }
        }
    }

    function isValidMail($email)
    {
        if (!strpos($email, '@')) {
            return false;
        }

        list($user, $domain) = explode('@', $email);

        if (!checkdnsrr($domain)) {
            return false;
        }

        $email_dummies = array(
            'example.com',
            'example.org',
            'example.net'
        );
        foreach ($email_dummies as $email_dummy) {
            if (str_contains($email, $email_dummy)) {
                return false;
            }
        }
        return true;
    }

    public function ActivityLog($message, $user_id)
    {
        return Activity::create([
            'content' => $message,
            'user_id' => $user_id
        ]);
    }

    public function appliedPost($user_id, $post_id)
    {
        $checkExist = Applied::where('user_id', $user_id)->where('post_id', $post_id)->count();
        if ($checkExist > 0)
        {
            return false;
        }
        return Applied::create([
            'user_id' => $user_id,
            'post_id' => $post_id
        ]);
    }

    public function unAppliedPost($user_id, $post_id)
    {
        return Applied::where('user_id', $user_id)->where('post_id', $post_id)->delete();
    }

    function createUser($getInfo, $provider)
    {
        return User::create([
            'name' => $getInfo->name,
            'username' => $getInfo->name,
            'email' => $getInfo->email,
            'provider' => $provider,
        ]);
    }

    public function saveImageReport($images, $ticket_id)
    {
        return Image::create([
           'image' =>  $images,
            'ticket_id' => $ticket_id
        ]);
    }
}
