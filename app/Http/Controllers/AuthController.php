<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller {

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {
        /* Validamos la data de entrada */
        $validator = Validator::make($request->all(), [
                    'password' => 'required',
                    'email' => 'required|email'
        ]);
        /* Si existe error */
        if ($validator->fails()) {
            return $this->respondWithErrorMessage($validator);
        }
        /* Procesamos peticion */
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Error in user or password'], 401);
        }
        /* Actualizamos token en usuario */
        \App\User::where('email', $request->get("email"))
                ->update(['token' => $token]);
        /* Retornamos informacion de la respuesta */
        return \App\User::whereEmail($request->get("email"))->first();
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }

}
