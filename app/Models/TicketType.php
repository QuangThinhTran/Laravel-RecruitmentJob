<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * @method static orderBy(string $string, string $string1)
 * @method static where(string $string, false|resource|string|null $content)
 */
class TicketType extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'ticket_type';
    protected $fillable = [
        'content',
    ];

    public function ticket()
    {
        return $this->hasMany(Ticket::class,'ticket_id');
    }
}
