<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLogger extends Model
{
    use HasFactory;
    protected $table = 'logs';


    protected $fillable = [
        'name',
        'email',
        'gender',
        'ipAddress',
        'activity',
        'description',
    ];
}
