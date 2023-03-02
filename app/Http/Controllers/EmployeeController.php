<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /*=====================================Estas funciones pertenecen al CRUD de Empleados===========================*/

    /* Función read con una variable $datos que recibe todos los campos de Sucursal 
    y abre la vista de que contiene el CRUD*/
    public function readEmpleado()
    {
        return view("crud-empleado", [
            'datos' => Employee::all(),
            'lista_empresa' => Company::all(),
            'lista_sucursal' => Branch::all()
        ]);

        //Misma función read pero con las consultas SQL
        
        /*$lista_empresa = DB::select("select cuit, nombre from empresa");
        $lista_sucursal = DB::select("select n_sucursal, sucursal.nombre, empresa.nombre as 'empresa' FROM sucursal 
        INNER JOIN empresa ON empresa.cuit = sucursal.cuit_empresa;");

        $datos = DB::select("select empleado.cuit_empresa, empleado.id, dni, empleado.nombre, empleado.apellido, empresa.nombre as 'empresa', 
        empleado.n_sucursal_pertenece, empleado.direccion, empleado.correo from empleado 
        INNER JOIN empresa ON empresa.cuit = empleado.cuit_empresa");
        return view("crud-empleado", [
            'datos' => $datos,
            'lista_empresa' => $lista_empresa,
            'lista_sucursal' => $lista_sucursal
        ]);*/
    }

    /* Función create que recibe los datos del formulario modal y los inserta en mi base de datos.
    Luego retorna a la página hacia atrás y muestra un mensaje.*/
    public function createEmpleado(Request $request)
    {
        $cuit_empresa = str_split($request->txtEmpresa, 11);
        $N_Sucursal = $request->txtN_Sucursal;
        if ($N_Sucursal == '-- Sin asignar --') {
            $N_Sucursal = null;
        }

        $op = true;
        try {
            $empleado = new Employee();
            $empleado->nombre = $request->txtNombre;
            $empleado->apellido = $request->txtApellido;
            $empleado->dni = $request->txtDNI;
            $empleado->cuit_empresa = $cuit_empresa[0];
            $empleado->n_sucursal_pertenece = $N_Sucursal;
            $empleado->direccion = $request->txtDireccion;
            $empleado->correo = $request->txtCorreo;
            $empleado->save();
        } catch (\Throwable $th) {
            $op = false;
        }
        if ($op == true) {
            return back()->with("exito", "Se ha registrado el empleado correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo registrar el empleado.");
        }

        //Misma función create pero con las consultas SQL

        /*try {
            $sql = DB::insert("insert into empleado(nombre, apellido, dni, cuit_empresa, n_sucursal_pertenece, 
            direccion, correo) values(?,?,?,?,?,?,?)", [
                $request->txtNombre,
                $request->txtApellido,
                $request->txtDNI,
                $cuit_empresa[0],
                $N_Sucursal,
                $request->txtDireccion,
                $request->txtCorreo
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("exito", "Se ha registrado el empleado correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo registrar el empleado.");
        }*/
    }

    /* Función update que recibe los datos del formulario modal y actualiza mi base de datos.
    Luego retorna a la página hacia atrás y muestra un mensaje.*/
    public function updateEmpleado(Request $request)
    {
        $op = true;
        try {
            $cuit_empresa = str_split($request->txtEmpresa, 11);
            $N_Sucursal = $request->txtN_Sucursal;
            if ($N_Sucursal == '-- Sin asignar --') {
                $N_Sucursal = null;
            }
            $empleado = Employee::find($request->txtID);
            $empleado->nombre = $request->txtNombre;
            $empleado->apellido = $request->txtApellido;
            $empleado->dni = $request->txtDNI;
            $empleado->cuit_empresa = $cuit_empresa[0];
            $empleado->n_sucursal_pertenece = $N_Sucursal;
            $empleado->direccion = $request->txtDireccion;
            $empleado->correo = $request->txtCorreo;
            $empleado->save();
        } catch (\Throwable $th) {
            $op = false;
        }
        if ($op == true) {
            return back()->with("exito", "Se han actualizado los datos del empleado correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo actualizar los datos del empleado.");
        }

        //Misma función update pero con la consulta SQL

        /*try {
            $cuit_empresa = str_split($request->txtEmpresa, 11);
            $N_Sucursal = $request->txtN_Sucursal;
            if ($N_Sucursal == '-- Sin asignar --') {
                $N_Sucursal = null;
            }

            $sql = DB::update("update empleado set nombre=?, apellido=?, dni=?, cuit_empresa=?, n_sucursal_pertenece=?, 
            direccion=?, correo=? where id=?", [
                $request->txtNombre,
                $request->txtApellido,
                $request->txtDNI,
                $cuit_empresa[0],
                $N_Sucursal,
                $request->txtDireccion,
                $request->txtCorreo,
                $request->txtID
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("exito", "Se han actualizado los datos del empleado correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo actualizar los datos del empleado.");
        }*/
    }

    public function deleteEmpleado($id)
    {
        $op = true;
        try {
            $empleado = Employee::find($id);
            $empleado->delete();
        } catch (\Throwable $th) {
            $op = false;
        }
        if ($op == true) {
            return back()->with("exito", "El empleado se ha eliminado correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo eliminar el empleado.");
        }

        //Misma función delete pero con la consulta SQL

        /*try {
            $sql = DB::delete("delete from empleado where id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("exito", "El empleado se ha eliminado correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo eliminar el empleado.");
        }*/
    }
}
