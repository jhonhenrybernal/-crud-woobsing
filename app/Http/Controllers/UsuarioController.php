<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
   public function index(){
        return
        response()->json([
            'data' => User::all()
        ]);
   }

   public function create(Request $request ){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'required',
            'correo' => 'required',
            'telefono' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $usuario = new User();
        $usuario->nombre = $request['nombre'];
        $usuario->apellido = $request['apellido'];
        $usuario->direccion = $request['direccion'];
        $usuario->email = $request['correo'];
        $usuario->telefono = $request['telefono'];
        $usuario->save();

        return
        response()->json([
            'status' => true
        ]);
   }

   public function edit($id){
        return response()->json([
                'us' => User::find($id),
                'status' =>true
            ]);
   }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'required',
            'correo' => 'required',
            'telefono' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $usuario = User::find($request['id']);
        $usuario->nombre = $request['nombre'];
        $usuario->apellido = $request['apellido'];
        $usuario->direccion = $request['direccion'];
        $usuario->email = $request['correo'];
        $usuario->telefono = $request['telefono'];
        $usuario->update();

        return
            response()->json([
                'status' => true
            ]);
    }
    public function delete($id)
    {
        $usuario = User::find($id);
        $usuario->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
