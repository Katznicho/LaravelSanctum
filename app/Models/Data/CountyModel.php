<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountyModel extends Model
{
    use HasFactory;
    //specific a table
    protected $table = 'county';

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
        "countyName"

    ];

    protected $hidden = ["id", "created_at", "updated_at"];
}
