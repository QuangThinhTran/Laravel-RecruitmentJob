<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * @method static orderBy(string $string, string $string1)
 * @method static find($id)
 * @method static where(string $string, mixed $content)
 */
class Role extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'role';
    protected $fillable = [
        'content',
    ];

    public function user()
    {
        return $this->hasOne(User::class,'user_id');
    }
}
