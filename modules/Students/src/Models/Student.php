<?php

namespace Modules\Students\src\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EmailVerifyQueued;

class Student extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'address',
        'phone',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerifyQueued);
    }
}