<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    //Establece en true el autoincremento de la tabla (en caso de tenerlo)
    public $incrementing = true;
    //Establece en false los timestamps de la tabla (en caso de tenerlos) 
    public $timestamps = false;

    //Establece el nombre de la tabla a la que hace referencia (en caso de ser necesario)
    protected $table = "empleado";
    //Establece la primaryKey de la tabla (en este caso no hace falta ya que se llama id)
    //protected $primaryKey = "id";

    public function empresa(){
        return $this->belongsTo(Company::class, 'cuit_empresa', 'cuit');
    }

    public function sucursal(){
        return $this->belongsTo(Branch::class, 'n_sucursal_pertenece', 'n_sucursal');
    }
}
