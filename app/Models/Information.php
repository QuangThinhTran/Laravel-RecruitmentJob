<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find($id)
 * @method static orderBy(string $string, string $string1)
 * @method static where(string $string, $id)
 */
class Information extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'information';
    protected $fillable = [
        'content',
        'user_id',
        'type_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNameInformation()
    {
        return $this->user->username;
    }

    public function type()
    {
        return $this->belongsTo(InformationType::class);
    }
}
