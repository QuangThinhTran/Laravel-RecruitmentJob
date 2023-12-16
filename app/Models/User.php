<?php

namespace App\Models;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static where(string $string, $email)
 * @method static orderBy(string $string, string $string1)
 * @method static find($id)
 * @method static whereNotNull(string $string)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CascadeSoftDeletes;
    use SoftDeletes;
    protected $table = 'user';

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'address',
        'img_avatar',
        'position',
        'major',
        'description',
        'password',
        'provider',
        'remember_token',//Dùng để ghi nhớ đăng nhập
        'role_id',
    ];

    public function post()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function company()
    {
        return $this->hasMany(Company::class, 'user_id');
    }

    public function information()
    {
        return $this->hasMany(Information::class, 'user_id');
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class,'from_user_id');
    }

    public function ticket2()
    {
        return $this->hasMany(Ticket::class,'to_user_id');
    }

    public function applied()
    {
        return $this->hasMany(Applied::class,'user_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($user){
            $user->post()->delete();
            $user->company()->delete();
            $user->information()->delete();
            $user->ticket()->delete();
            $user->applied()->delete();
            $user->ticket2()->delete();
        });

        static::restoring(function ($user){
            $user->post()->onlyTrashed()->restore();
            $user->company()->onlyTrashed()->restore();
            $user->information()->onlyTrashed()->restore();
            $user->ticket()->onlyTrashed()->restore();
            $user->ticket2()->onlyTrashed()->restore();
            $user->applied()->onlyTrashed()->restore();
        });
    }

    public function scopeSearch($query)
    {
        if (request('key'))
        {
            $key = request('key');
            $query = $query->where('name', 'like', '%' . $key . '%');
        }
        return $query;
    }
}
