<?php

use Illuminate\Contracts\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notification;

class User extends Authenticatable
{
    use Notifiable;
    public $table = "user";
    public $primaryKey = "id";
    public $timestamps = true;

    protected $fillable = [
      'name', 'email', 'password', 'phone', 'social_id'
    ];

    protected  $hidden = [
        'password', 'remember_token',
    ];
}