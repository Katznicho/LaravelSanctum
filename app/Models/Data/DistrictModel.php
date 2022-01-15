<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictModel extends Model
{
    use HasFactory;
    //specific a table
    protected $table = 'districts';

    //primary key
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'districtCode',
        "districtName",


    ];

    protected $hidden = ["id", "created_at", "updated_at"];
}
