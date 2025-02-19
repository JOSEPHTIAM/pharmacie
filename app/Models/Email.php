<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Email
 *
 * @property string $sender
 * @property string $recipient
 * @property string|null $subject
 * @property string|null $message
 * 
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */



class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',
        'recipient',
        'subject',
        'message',
    ];

}
