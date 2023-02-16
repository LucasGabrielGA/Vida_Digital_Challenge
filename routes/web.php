<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*========================================= Rutas pertenecientes al LOGIN =============================================*/

/*Ruta principal al login (de tipo GET)*/
Route::get('/', [LoginController::class, "welcomeLogin"])->name('login')->middleware('guest');

/*Ruta para el logueo del usuario*/
Route::post('login', [LoginController::class, "verifyCredentials"])->name("vidadigital_challenge.verifyCredentials");

/*Ruta para el logout del usuario*/
Route::post('logout', [LoginController::class, "logout"])->name("vidadigital_challenge.logout");

/*Ruta para el registro del usuario*/
Route::post('/registrar-usuario', [LoginController::class, "registerUser"])->name("vidadigital_challenge.registerUser");

/*=====================================Rutas pertenecientes al CRUD de Empresas========================================*/

/*Ruta para el listado*/
Route::get("/leer-empresa", [CompanyController::class, "readEmpresa"])->name("vidadigital_challenge.readEmpresa")->middleware('auth');

/*Ruta para el registro*/
Route::post("/registrar-empresa", [CompanyController::class, "createEmpresa"])->name("vidadigital_challenge.createEmpresa")->middleware('auth');

/*Ruta para modificar o actualizar*/
Route::post("/modificar-empresa", [CompanyController::class, "updateEmpresa"])->name("vidadigital_challenge.updateEmpresa")->middleware('auth');

/*Ruta para eliminar*/
Route::get("/eliminar-empresa-{cuit}", [CompanyController::class, "deleteEmpresa"])->name("vidadigital_challenge.deleteEmpresa")->middleware('auth');

/*=====================================Rutas pertenecientes al CRUD de Sucursales========================================*/

/*Ruta para el listado*/
Route::get("/leer-sucursal", [BranchController::class, "readSucursal"])->name("vidadigital_challenge.readSucursal")->middleware('auth');;

/*Ruta para el registro*/
Route::post("/registrar-sucursal", [BranchController::class, "createSucursal"])->name("vidadigital_challenge.createSucursal")->middleware('auth');

/*Ruta para modificar o actualizar*/
Route::post("/modificar-sucursal", [BranchController::class, "updateSucursal"])->name("vidadigital_challenge.updateSucursal")->middleware('auth');

/*Ruta para eliminar*/
Route::get("/eliminar-sucursal-{n_sucursal}", [BranchController::class, "deleteSucursal"])->name("vidadigital_challenge.deleteSucursal")->middleware('auth');

/*=====================================Rutas pertenecientes al CRUD de Empleado========================================*/

/*Ruta para el listado*/
Route::get("/leer-empleado", [EmployeeController::class, "readEmpleado"])->name("vidadigital_challenge.readEmpleado")->middleware('auth');

/*Ruta para el registro*/
Route::post("/registrar-empleado", [EmployeeController::class, "createEmpleado"])->name("vidadigital_challenge.createEmpleado")->middleware('auth');

/*Ruta para modificar o actualizar*/
Route::post("/modificar-empleado", [EmployeeController::class, "updateEmpleado"])->name("vidadigital_challenge.updateEmpleado")->middleware('auth');

/*Ruta para eliminar*/
Route::get("/eliminar-empleado-{id}", [EmployeeController::class, "deleteEmpleado"])->name("vidadigital_challenge.deleteEmpleado")->middleware('auth');
