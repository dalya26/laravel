<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\alumnoController;
use App\Http\Controllers\grupoController;
use App\Http\Controllers\materiaController;
use App\Http\Controllers\profesorController;
use App\Http\Controllers\rolesController;
use App\Http\Controllers\paselista_controller;
use App\Http\Controllers\rolController;
use App\Http\Controllers\usersController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
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

/**Route::post('login', function (Request $request) {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'rol' => $request->rol, 'id_rol' => $request->id_rol])) {
        $user = Auth::user();
        $arr = array('acceso' => "Ok", 'error' => "");
        return json_encode($arr);
    } else {
        $arr = array('acceso' => "", 'error' => "No existe el usuario o contraseña");
        return json_encode($arr);
    }
});*/

Route::post('login', function (Request $request) {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'rol' => "Admin"])) {
        $user = Auth::user()->id;
        $arr = array('userid' => $user,'acceso'=> "Admin" ,'error' => "");
        return json_encode($arr);

    }if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'rol' => "Student"])) {
        $user = Auth::user()->id;
        $arr = array('userid' => $user,'acceso'=> "Student" ,'error' => "");
        return json_encode($arr);

    } if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'rol' => "Teacher"])) {
        $user = Auth::user()->id;
        $arr = array('userid' => $user,'acceso'=> "Teacher" ,'error' => "");
        return json_encode($arr);
    }
    else {
        $arr = array('acceso' => "", 'error' => "No existe el usuario o contraseña");
        return json_encode($arr);
    }

})->name('admin.users');
Route::get('/user', [usersController::class, 'lista'])->name('admin.users');
Route::get('/users', [usersController::class, 'users'])->name('admin.users');
Route::post('/user/borrar', [usersController::class, 'borrar'])->name('admin.users');
/**Route::post('/registeruser', [usersController::class, 'registeruser'])->name('admin.users');
Route::get('/user', [usersController::class, 'lista'])->name('admin.users');
Route::get('/users', [usersController::class, 'users'])->name('admin.users');
Route::post('/user/borrar', [usersController::class, 'borrar'])->name('admin.users');*/

Route::get('/rol', [rolesController::class, 'lista'])->name('admin.rol');
Route::get('/role', [rolesController::class, 'roles'])->name('admin.rol');
Route::get('/rol/combo', [rolesController::class, 'combo'])->name('admin.rol');

});


Route::post('/paselista', [paselista_controller::class, 'paselista']);
Route::post('/guardarpaselista', [paselista_controller::class, 'guardar']);

Route::post('/registeruser', [usersController::class, 'registeruser']);
Route::get('/user', [usersController::class, 'lista']);
Route::get('/users', [usersController::class, 'users']);
//Route::post('/login', [usersController::class, 'login']);
Route::post('/user/borrar', [usersController::class, 'borrar']);


