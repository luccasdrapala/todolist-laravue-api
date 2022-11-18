<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{   
    private $authService;

    public function __construct(AuthService $authService){

        $this->authService = $authService;
    }
    
    public function login(AuthLoginRequest $request){
        
        $input = $request->validated();
        $token = $this->authService->login_user($input['email'], $input['password']);
        
        return (new UserResource(auth()->user()))->additional($token);
        //retorna o UserResource e o token
    }
}
