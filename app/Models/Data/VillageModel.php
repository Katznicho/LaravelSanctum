<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageModel extends Model
{
    use HasFactory;

    //specific a table
    protected $table = 'villages';

    //primary key
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'districtCode',
        'countyCode',
        'subCountyCode',
        "parishCode",
        'villageCode',
        'villageName'

    ];

    protected $hidden = ["id", "created_at", "updated_at"];
}
