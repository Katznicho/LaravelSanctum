<?php

namespace App\Models\Stations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelStationModel extends Model
{
    use HasFactory;

    //specific a table
    protected $table = 'fuelstation';

    //primary key
    protected $primaryKey = 'fuelStationId';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fuelStationName',
        "fuelStationContactPerson",
        'fuelStationContactPhone',
        'NIN',
        'frontIDPhoto',
        'backIDPhoto',
        'fuelStationStatus',
        'totalAmount',
        'currentAmount',
        'bankName',
        'bankBranch',
        'AccName',
        'AccNumber',
        'merchantCode',
        'districtCode',
        'countyCode',
        'subCountyCode',
        'parishCode',
        'villageCode',
        "latitude",
        "longitude"

    ];

    protected $hidden = ["created_at", "updated_at", "fuelStationAddress"];
}
