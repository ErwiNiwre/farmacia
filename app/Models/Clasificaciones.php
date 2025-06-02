<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clasificaciones extends Model
{
     use HasFactory, SoftDeletes;
    protected $table = 'clasificaciones';
}
