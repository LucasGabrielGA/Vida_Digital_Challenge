<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /*=====================================Estas funciones pertenecen al CRUD de Empresas===========================*/

    /* Función index con una variable $datos que recibe todos los campos de Empresa 
    y abre la vista de que contiene el CRUD*/
    public function readEmpresa()
    {
        $datos = DB::select("select * from empresa");
        return view("crud-empresa")->with("datos", $datos);
    }

    /* Función create que recibe los datos del formulario modal y los inserta en mi base de datos.
    Luego retorna a la página hacia atrás y muestra un mensaje.*/
    public function createEmpresa(Request $request)
    {
        try {
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
        }
    }

    /* Función update que recibe los datos del formulario modal y actualiza mi base de datos.
    Luego retorna a la página hacia atrás y muestra un mensaje.*/
    public function updateEmpresa(Request $request)
    {
        try {
            $sql = DB::update("update empresa set nombre=?, direccion=?, correo=? where cuit=?", [
                $request->txtNombre,
                $request->txtDireccion,
                $request->txtCorreo,
                $request->txtCuit
            ]);
            /* En el caso de que no hubiera cambios al ejecutarse la consulta, 
            logro que no se muestre el mensaje de fallo. */
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
        }
    }

    /* Función delete que elimina la empresa elegida y actualiza mi base de datos.
    Luego retorna a la página hacia atrás y muestra un mensaje.*/
    public function deleteEmpresa($cuit)
    {
        try {
            $sql = DB::delete("delete from empresa where cuit=$cuit");
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("exito", "La empresa se ha eliminado correctamente.");
        } else {
            return back()->with("fallo", "Ha ocurrido un error y no se pudo eliminar la empresa.");
        }
    }
}
