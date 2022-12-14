<?php

namespace App\Http\Controllers;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use App\Http\Requests\AuthVerifyEmailRequest;

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

    public function register(AuthRegisterRequest $request){

        $input = $request->validated(); //recebe apenas campos validados
        $user = $this->authService->register($input['first_name'], $input['last_name'], $input['email'], $input['password']); 

        return new UserResource($user);
    }

    public function verifyEmail(AuthVerifyEmailRequest $request) 
    {   
        $input = $request->validated();

        $user = $this->authService->verifyEmail($input['token']);

        return new UserResource($user);
    }
}
