<?php

namespace App\Http\Controllers;

use App\Models\m_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usersController extends Controller
{
    public function index(){
        return view('users');
        
    }
    public function lista(){
        $user = m_user::all();
        /**$user = m_user::join('roles', 'users.id_rol', '=', 'roles.id')
        ->select('users.*', 'roles.name as rol_rol')
        ->get();*/
        return $user;
    }
    public function users(Request $request){
        $user = m_user::find($request->id);
        return $user;
    }
    public function registeruser(Request $request){
        if($request->id == 0){
            $user = new m_user();
        }
        else{
            $user = m_user::find($request->id);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->input('password'));
        $user->rol = $request->rol;

        $user->save();
        return $user;
    }

    public function login(Request $request){
        $user = m_user::where('email', $request->email)->first();
        if($user || Hash::check($request->password,$user->password))
        {
            return ["Error"=>"El correo o la contraseña no coinciden."];
        }
        return $user;
    }

    public function borrar(Request $request)
    {
        $user = m_user::find($request->id);
        $user->delete();
        return "OK";
    }
}
