<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /*=====================================Estas funciones pertenecen al CRUD de Empresas===========================*/


    public function readEmpresa()
    {
        return view("crud-empresa")->with("datos", Company::all());

        //Misma función pero hecho con la consulta Select de SQL
        /*$datos = DB::select("select * from empresa");
        return view("crud-empresa")->with("datos", $datos);*/
    }

    /* Función create que recibe los datos del formulario modal y los inserta en mi base de datos.
    Luego retorna a la página hacia atrás y muestra un mensaje.*/
    public function createEmpresa(Request $request)
    {
        /* Función hecha con Eloquent */
        $op = true;
        try {
            $empresa = new Company();
            $empresa->cuit = $request->txtCuit;
            $empresa->nombre = $request->txtNombre;
            $empresa->direccion = $request->txtDireccion;
            $empresa->correo = $request->txtCorreo;
            $empresa->save();
        } catch (\Throwable $th) {
            $op = false;
        }

        if($op == true){
            return back()->with("exito", "Se ha registrado la empresa correctamente.");
        }
        else{
            return back()->with("fallo", "Ha ocurrido un error y no se pudo registrar la empresa.");
        }

        //Misma función pero hecho con la consulta Insert de SQL
        /*try {
            $sql = DB::insert("insert into empresa(cuit, nombre, direccion, correo) values(?,?,?,?)", [
                $request->txtCuit,
                $request->txtNombre,
                $request->txtDireccion,
                $request->txtCorreo
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("exito", "Se ha registrado la empresa correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo registrar la empresa.");
        }*/
    }

    /* Función update que recibe los datos del formulario modal y actualiza mi base de datos.
    Luego retorna a la página hacia atrás y muestra un mensaje.*/
    public function updateEmpresa(Request $request)
    {
        $op = true;
        try {
            $empresa = Company::find($request->txtCuit);
            $empresa->nombre = $request->txtNombre;
            $empresa->direccion = $request->txtDireccion;
            $empresa->correo = $request->txtCorreo;
            $empresa->save();
        } catch (\Throwable $th) {
            $op = false;
        }

        if ($op == true) {
            return back()->with("exito", "Se ha actualizado los datos de la empresa correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo actualizar la empresa.");
        }

        //Misma función pero hecho con la consulta Update de SQL
        /*try {
            $sql = DB::update("update empresa set nombre=?, direccion=?, correo=? where cuit=?", [
                $request->txtNombre,
                $request->txtDireccion,
                $request->txtCorreo,
                $request->txtCuit
            ]);
            // En el caso de que no hubiera cambios al ejecutarse la consulta
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("exito", "Se ha actualizado los datos de la empresa correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo actualizar la empresa.");
        }*/
    }
    
    /* Función delete que elimina la empresa elegida y actualiza mi base de datos.
    Luego retorna a la página hacia atrás y muestra un mensaje.*/
    public function deleteEmpresa($cuit)
    {
        $op = true;
        try {
            $empresa = Company::find($cuit);
            $empresa->delete();
        } catch (\Throwable $th) {
            $op = false;
        }

        if ($op == true) {
            return back()->with("exito", "La empresa se ha eliminado correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo eliminar la empresa.");
        }

        //Misma función pero hecho con la consulta Delete de SQL
        /*try {
            $sql = DB::delete("delete from empresa where cuit=$cuit");
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("exito", "La empresa se ha eliminado correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo eliminar la empresa.");
        }*/
    }
}
