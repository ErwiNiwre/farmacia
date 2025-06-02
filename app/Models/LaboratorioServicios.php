<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaboratorioServicios extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'laboratorio_servicios';
}
