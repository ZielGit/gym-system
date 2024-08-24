<?php

namespace App\Controllers\Api;

use App\Models\User;
use Config\PHPJWT;

class AuthController
{
    private $PHPJWT;

    public function __construct()
    {
        $this->PHPJWT = new PHPJWT();
    }

    public function login()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        // Verificar las credenciales del usuario (email y password)
        $user = User::where('email', $data['email'])->first();

        if (!$user || !password_verify($data['password'], $user->password)) {
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