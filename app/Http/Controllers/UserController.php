<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller {

    private $fieldsCreate = [
        'first_name' => 'required',
        'last_name' => 'required',
        'age' => 'required',
        'image' => 'required',
        'password' => 'required',
        'email' => 'required|email',
    ];
    
    private $validationGeneral = [
        'first_name' => 'required',
        'last_name' => 'required',
        'age' => 'required',
        'image' => 'required',
        'email' => 'required|email',
        'description' => 'required',
    ];

    public function create(Request $request) {
        /* Validamos la data de entrada */
        $validator = Validator::make($request->all(),$this->fieldsCreate);
        /* Si existe error */
        if ($validator->fails()) {
            return $this->respondWithErrorMessage($validator);
        }
        $row = $request->all();
        /* Se valida que no exista otro email */
        if (\App\User::where('email', $row['email'])->first()) {
            return response()->json(['error' => "Email already exists"], 500);
        }
        $row['password'] = bcrypt($row['password']);
        $row['token'] = null;
        return \App\User::create($row);
    }
    
    public function update($id, Request $request) {
        /* Validamos la data de entrada */
        $validator = Validator::make($request->all(), $this->validationGeneral);
        /* Si existe error */
        if ($validator->fails()) {
            return $this->respondWithErrorMessage($validator);
        }
        $row = $request->all();
        /* Se valida que no exista otro email */
        if (\App\User::where([['email', '=', $row['email']], ['id', '!=', $id],])->first()) {
            return response()->json(['error' => "Email already exists in another row"], 500);
        }
        /* Actualizamos registro */
        \App\User::where('id', $id)->update($row);
        return \App\User::find($id);
    }

    public function updatePartial($id, Request $request) {
        $row = $request->all();
        $finalValidate = [];
        /* Validamos si existe algun campo inesperado */
        foreach ($row as $index => $validation) {
            if (!array_key_exists($index, $this->validationGeneral)) {
                return response()->json(['error' => sprintf("Unexpected field: %s", $index)], 500);
            } else {
                $finalValidate[$index] = $this->validationGeneral[$index];
            }
        }
        /* Validamos la data de entrada */
        $validator = Validator::make($row, $finalValidate);
        /* Si existe error */
        if ($validator->fails()) {
            return $this->respondWithErrorMessage($validator);
        }
        /* Se valida que no exista otro email */
        if (isset($row['email']) && \App\User::where([['email', '=', $row['email']], ['id', '!=', $id],])->first()) {
            return response()->json(['error' => "Email already exists in another row"], 500);
        }
        /* Actualizamos registro */
        \App\User::where('id', $id)->update($row);
        return \App\User::find($id);
    }
    
    public function list(Request $request) {
        return \App\User::all();
    }
    
    public function show($id, Request $request) {
        return \App\User::where('id',$id)->first();
    }
    
    public function delete($id, Request $request) {
        /* Capturamos usuario */
        $user = \App\User::where('id',$id)->first();
        /* Eliminamos usuario */
        \App\User::where('id',$id)->delete();
        /* Mostramos usuario */
        return $user;
    }

}
