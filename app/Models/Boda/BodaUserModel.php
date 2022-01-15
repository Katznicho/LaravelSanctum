<?php

namespace App\Models\Boda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodaUserModel extends Model
{
    use HasFactory;


    //specific a table
    protected $table = 'bodauser';

    //primary key
    protected $primaryKey = 'bodaUserId';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bodaUserName',
        "bodaUserStatus",
        'bodaUserNIN',
        'bodaUserPin',
        'bodaUserPhoneNumber',
        "bodaUserBodaNumber",
        "bodaUserBackPhoto",
        "bodaUserFrontPhoto",
        "bodaUserRole",
        "alternativePhotoNumber",
        'fuelStationId',
        "stageId",
        "pin",
        "latitude",
        "longitude"

    ];

    protected $hidden = ["created_at", "updated_at", "bodaUserId"];
}
