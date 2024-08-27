<?php

namespace App\Controllers\Api;

use App\Models\User;
use Config\PHPJWT;
use Core\Request;

class AuthController
{
    private $PHPJWT;

    public function __construct()
    {
        $this->PHPJWT = new PHPJWT();
    }

    public function login()
    {
        $request = new Request;

        // Verificar las credenciales del usuario (email y password)
        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !password_verify($request->input('password'), $user->password)) {
            http_response_code(401);
            echo json_encode(['message' => 'Invalid credentials']);
            return;
        }

        // Generar token JWT
        $token = $this->PHPJWT->generateToken([
            'user_id' => $user->id,
            'email' => $user->email,
        ]);

        $response = [
            'message' => 'Hi '. $user->name,
            'token' => $token,
            'token_type' => 'Bearer'
        ];

        echo json_encode($response);
    }

    public function logout()
    {
        // Despues crear una black list en el AuthMiddleware para los tokens
        echo json_encode(['message' => 'Logged out successfully']);
    }
}