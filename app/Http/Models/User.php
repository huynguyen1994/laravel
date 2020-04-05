<?php
namespace App\Http\Models;

use Illuminate\Contracts\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use Notifiable;
    public $table = "users";
    public $primaryKey = "id";
    public $timestamps = true;

    protected $fillable = [
      'name', 'email', 'password', 'phone', 'social_id'
    ];

    protected  $hidden = [
        'password',
    ];
}