<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    //Establece en falso el autoincremento de la tabla (en caso de tenerlo)
    public $incrementing = false;
    //Establece en falso los timestamps de la tabla (en caso de tenerlos) 
    public $timestamps = false;

    //Establece el nombre de la tabla a la que hace referencia (en caso de ser necesario)
    protected $table = "empresa";
    //Establece la primaryKey de la tabla (apunta hacia ella)
    protected $primaryKey = "cuit";
}
