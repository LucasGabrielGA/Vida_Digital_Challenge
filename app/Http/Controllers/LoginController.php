<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /* Función con la ruta con método POST */
    public function welcomeLogin(){
        return view("login");
    }

    /* Función Logout para el deslogeo del usuario con método GET */
    public function logout(){
        Auth::logout();

        request()->session()->invalidate();         //Con esto se invalida la sesión del usuario
        request()->session()->regenerateToken();    //Con esto se regenera el token de sesión del usuario

        return redirect('/');
    }

    /* Función verifyCredentials para el logeo del usuario */
    public function verifyCredentials(){

        $credentials = request()->only('email', 'password');

        if(Auth::attempt($credentials)){
            //Regenerar la sesión del usuario
            request()->session()->regenerate(); //Session Fixation | para evitar un hueco de vulnerabilidad o intercepción de datos del usuario
            
            return redirect('/leer-empresa');
        }
        return redirect('/')->with("fallo", "El email o la contraseña son incorrectas.");
    }

    /* Función registerUser para el registro del usuario */
    public function registerUser(Request $request){
        $password = $request->txtPassword;
        $password = Hash::make($password);          //Se crea la contraseña del usuario encriptada
        $email = $request->txtEmail;
        $nombre = $request->txtNombre;

        try {
            $sql= DB::table('users')->insert(['name'=> $nombre,'email'=>$email, 'password'=>$password]);
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == true) {
            return redirect('/')->with("exito", "Se ha registrado como Usuario correctamente.");
        } else {
            return redirect('/')->with("fallo", "Ha ocurrido un error y no se pudo registrar.");
        }
    }
}
