<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    //Establece en true el autoincremento de la tabla (en caso de tenerlo)
    public $incrementing = true;
    //Establece en false los timestamps de la tabla (en caso de tenerlos) 
    public $timestamps = false;

    //Establece el nombre de la tabla a la que hace referencia (en caso de ser necesario)
    protected $table = "sucursal";
    //Establece la primaryKey de la tabla (apunta hacia ella)
    protected $primaryKey = "n_sucursal";

    //Se crea una relación entre las tablas Sucursal y Empresa (INNER JOIN)
    public function empresa(){
        return $this->belongsTo(Company::class, 'cuit_empresa', 'cuit');
    }
}
