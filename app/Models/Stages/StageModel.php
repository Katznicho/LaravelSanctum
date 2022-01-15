<?php

namespace App\Models\Stages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StageModel extends Model
{
    use HasFactory;

    //specific a table
    protected $table = 'stage';

    //primary key
    protected $primaryKey = 'stageId';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stageName',
        "stageStatus",
        'chairmanId',
        'fuelStationId',
        'districtCode',
        'countyCode',
        'subCountyCode',
        'parishCode',
        'villageCode'

    ];

    protected $hidden = ["created_at", "updated_at"];
}
