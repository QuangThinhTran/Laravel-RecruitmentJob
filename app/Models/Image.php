<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where()
 */
class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'images';
    protected $fillable = [
        'image',
        'ticket_id',
        'review_id'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
