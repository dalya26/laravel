<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\alumnoController;
use App\Http\Controllers\grupoController;
use App\Http\Controllers\materiaController;
use App\Http\Controllers\profesorController;
use App\Http\Controllers\rolController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/alumnos', [alumnoController::class, 'lista'])->name('admin.alumnos');
Route::get('/alumno', [alumnoController::class, 'alumno'])->name('admin.alumno');
Route::post('/alumno', [alumnoController::class, 'guardar'])->name('admin.guardar');
Route::post('/alumno/borrar', [alumnoController::class, 'borrar'])->name('admin.borrar');

//Rutas de la página de profesor

Route::get('/profesores', [profesorController::class,'lista'])->name('admin.profesor');
Route::get('/profesor', [profesorController::class, 'profesor'])->name('admin.profesor');
Route::post('/profesor', [profesorController::class, 'guardar'])->name('admin.profesor');
Route::post('/profesor/borrar',[profesorController::class,'borrar'])->name('admin.profesor');

//Route::get('/combo_profesores', [materiaController::class, 'combo']);
//Rutas de la página de materia

Route::get('/materias', [materiaController::class, 'lista'])->name('admin.materia');
Route::get('/materia', [materiaController::class, 'materia'])->name('admin.materia');
Route::post('/materia', [materiaController::class, 'guardar'])->name('admin.materia');
Route::post('/materia/borrar', [materiaController::class, 'borrar'])->name('admin.materia');

Route::get('/combo_materias', [materiaController::class, 'combo'])->name('admin.materia');

Route::get('/grupos', [grupoController::class, 'lista'])->name('admin.grupo');
Route::get('/grupo', [grupoController::class, 'grupos'])->name('admin.grupo');
Route::post('/grupo', [grupoController::class, 'guardar'])->name('admin.grupo');
Route::post('/grupo/borrar', [grupoController::class, 'borrar'])->name('admin.grupo');
Route::get('/grupo/combo', [grupoController::class, 'combo'])->name('admin.grupo');

Route::post('login', function (Request $request) {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();
        $arr = array('acceso' => "Ok", 'error' => "");
        return json_encode($arr);
    } else {
        $arr = array('acceso' => "", 'error' => "No existe el usuario o contraseña");
        return json_encode($arr);
    }
});

Route::post('/registeruser', [usersController::class, 'registeruser'])->name('admin.users');
Route::get('/user', [usersController::class, 'lista'])->name('admin.users');
Route::get('/users', [usersController::class, 'users'])->name('admin.users');
Route::post('/user/borrar', [usersController::class, 'borrar'])->name('admin.users');

