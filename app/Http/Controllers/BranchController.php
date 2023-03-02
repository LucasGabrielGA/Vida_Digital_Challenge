<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    /*=====================================Estas funciones pertenecen al CRUD de Sucursales===========================*/

    /* Función read con una variable $datos que recibe todos los campos de Sucursal 
    y abre la vista de que contiene el CRUD*/
    public function readSucursal()
    {
        return view("crud-sucursal", [
            'datos' => Branch::all(),
            'lista_empresa' => Company::all()
        ]);

        //Misma función pero hecho con las consultas SQL

       /*//Esta variable va a guardar la lista de empresas para los formularios.
        $lista_empresa = DB::select("select cuit, nombre from empresa");

        //Esta variable va a guardar la lista de sucursales junto al nombre de la empresa que pertenece
        $datos = DB::select("select n_sucursal, cuit_empresa, sucursal.direccion, sucursal.nombre, 
        empresa.nombre as 'empresa' FROM sucursal INNER JOIN empresa ON empresa.cuit = sucursal.cuit_empresa");
        return view("crud-sucursal", [
            'datos' => $datos,
            'lista_empresa' => $lista_empresa
        ]);¨*/
    }

    /* Función create que recibe los datos del formulario modal y los inserta en mi base de datos.
    Luego retorna a la página hacia atrás y muestra un mensaje.*/
    public function createSucursal(Request $request)
    {
        $op = true;
        try {
            $cuit_empresa = str_split($request->txtEmpresa, 11);

            $sucursal = new Branch();
            $sucursal->cuit_empresa = $cuit_empresa[0];
            $sucursal->direccion = $request->txtDireccion;
            $sucursal->nombre = $request->txtNombre;
            $sucursal->save();
        } catch (\Throwable $th) {
            $op = false;
        }
        if ($op == true) {
            return back()->with("exito", "Se ha registrado la sucursal correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo registrar la sucursal.");
        }

        //Misma función pero con la consulta SQL

        /*try {
            $cuit_empresa = str_split($request->txtEmpresa, 11);

            $sql = DB::insert("insert into sucursal(cuit_empresa, direccion, nombre) values(?,?,?)", [
                $cuit_empresa[0],
                $request->txtDireccion,
                $request->txtNombre
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("exito", "Se ha registrado la sucursal correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo registrar la sucursal.");
        }*/
    }

    /* Función update que recibe los datos del formulario modal y actualiza mi base de datos.
    Luego retorna a la página hacia atrás y muestra un mensaje.*/
    public function updateSucursal(Request $request)
    {
        $op = true;
        try {
            $sucursal = Branch::find($request->txtN_Sucursal);
            $sucursal->direccion = $request->txtDireccion;
            $sucursal->nombre = $request->txtNombre;
            $sucursal->save();
        } catch (\Throwable $th) {
            $op = false;
        }
        if ($op == true) {
            return back()->with("exito", "Se ha actualizado los datos de la sucursal correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo actualizar la sucursal.");
        }

        //Misma función update pero con la consulta SQL

        /*try {
            $sql = DB::update("update sucursal set direccion=?, nombre=? where n_sucursal=?", [
                $request->txtDireccion,
                $request->txtNombre,
                $request->txtN_Sucursal
            ]);
            //En el caso de que no hubiera cambios al ejecutarse la consulta
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("exito", "Se ha actualizado los datos de la sucursal correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo actualizar la sucursal.");
        }*/
    }

    public function deleteSucursal($n_sucursal)
    {
        $op = true;
        try {
            $sucursal = Branch::find($n_sucursal);
            $sucursal->delete();
        } catch (\Throwable $th) {
            $op = false;
        }
        if ($op == true) {
            return back()->with("exito", "Se ha eliminado la sucursal correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo eliminar la sucursal.");
        }

        //Misma función delete pero con la consulta SQL

        /*try {
            $sql = DB::delete("delete from sucursal where n_sucursal=$n_sucursal");
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("exito", "Se ha eliminado la sucursal correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo eliminar la sucursal.");
        }*/
    }
}
