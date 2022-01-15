<?php

namespace App\Models\Auth;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminModel extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    //specific a table
    protected $table = 'administrators';

    //primary key
    protected $primaryKey = 'adminId';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        "email",
        'password',
        'email',
        'roleId',
        'phoneNumber',
        'profilePicture',
        'forgotPassword',
        'setPassword',
        'healthPlatformId',
        'gender'

    ];

    protected $hidden = ["password", "setPassword", "forgotPassword", "adminId", "created_at", "updated_at"];
}
