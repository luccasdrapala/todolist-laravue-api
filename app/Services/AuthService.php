<?php

namespace App\Services;
use App\User;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTaken;
use App\Http\Requests\AuthRegisterRequest;

class AuthService{

    public function login_user(string $email, string $password){

        $login =[
            'email' => $email,
            'password' => $password
        ];

        if(!$token = auth()->attempt($login)){ //responsável por logar o usuário 
            
            throw new LoginInvalidException();
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }

    public function register(string $first_name, string $last_name, string $email, string $password){
        
        $user = User::where('email', $email)->exists();
        if (!empty($user)){
            throw new UserHasBeenTaken();
        }

        $userPassword = bcrypt($password ?? string::random(10));

        $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $userPassword,
            'confirmation_token' => string::random(60)
        ]);

        return $user;
    }
}