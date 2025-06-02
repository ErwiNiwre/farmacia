<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadMedidas extends Model
{
     use HasFactory, SoftDeletes;
    protected $table = 'unidad_medidas';
}
