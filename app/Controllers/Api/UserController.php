<?php

namespace App\Controllers\Api;

use App\Middleware\AuthMiddleware;
use App\Models\User;
use Core\Request;

class UserController
{
    public function __construct()
    {
        $auth = new AuthMiddleware();
        $auth->handle();
    }

    public function index()
    {
        $users = User::all();
        echo json_encode($users);
    }

    public function store()
    {
        $request = new Request;
        $user = User::create([
            'document_type'=> $request->input('document_type'),
            'document_number'=> $request->input('document_number'),
            'name'=> $request->input('name'),
            'paternal_surname'=> $request->input('paternal_surname'),
            'maternal_surname'=> $request->input('maternal_surname'),
            'email'=> $request->input('email'),
            'phone'=> $request->input('phone'),
            'password'=> password_hash($request->input('password'), PASSWORD_BCRYPT),
        ]);
        $data = [
            'message' => 'User created successfully',
            'user' => $user
        ];
        echo json_encode($data);
    }

    public function show($id)
    {
        $user = User::find($id);
        echo json_encode($user);
    }

    public function update($id)
    {
        $request = new Request;
        $user = User::find($id);
        $data = [
            'document_type'=> $request->input('document_type'),
            'document_number'=> $request->input('document_number'),
            'name'=> $request->input('name'),
            'paternal_surname'=> $request->input('paternal_surname'),
            'maternal_surname'=> $request->input('maternal_surname'),
            'email'=> $request->input('email'),
            'phone'=> $request->input('phone'),
        ];
        if ($request->input('password')) {
            $data['password'] = password_hash($request->input('password'), PASSWORD_BCRYPT);
        }
        $user->update($data);
        $response = [
            'message' => 'User updated successfully',
            'user' => $user
        ];
        echo json_encode($response);
    }

    public function updateStatus($id)
    {
        $request = new Request;
        $user = User::find($id);
        $user->update([
            'status' => $request->input('status')
        ]);
        $data = [
            'message' => 'User status updated successfully',
            'user' => $user
        ];
        echo json_encode($data);
    }

    public function changePassword($id)
    {
        $request = new Request;
        $user = User::find($id);

        $oldPassword = $request->input('old_password');

        if (!password_verify($oldPassword, $user->password)) {
            http_response_code(400);
            echo json_encode(['message' => 'The current password you entered is not valid']);
            return;
        }

        $user->update([
            'password'=> password_hash($request->input('new_password'), PASSWORD_BCRYPT),
        ]);
        $response = [
            'message' => 'User password updated successfully',
            'user' => $user
        ];
        echo json_encode($response);
    }
}
