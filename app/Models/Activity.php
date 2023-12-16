<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $string, string $string1, $from)
 * @method static find()
 */
class Activity extends Model
{
    use HasFactory;
    protected $table = 'activity_log';
    protected $fillable = [
        'content',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
