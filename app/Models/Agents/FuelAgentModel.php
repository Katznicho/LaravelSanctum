<?php

namespace App\Models\Agents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelAgentModel extends Model
{
    use HasFactory;

    //specific a table
    protected $table = 'fuelagent';

    //primary key
    protected $primaryKey = 'fuelAgentId';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fuelAgentName',
        'fuelAgentPhoneNumber',
        "status",
        'anotherPhoneNumber',
        "backIDPhoto",
        "frontIDPhoto",
        'stationId',
        "status",
        "pin",
        "latitude",
        "longitude"

    ];

    protected $hidden = ["created_at", "updated_at"];
}
