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
        $data = [
            'document_type'=> $request->input('document_type'),
            'document_number'=> $request->input('document_number'),
            'name'=> $request->input('name'),
            'paternal_surname'=> $request->input('paternal_surname'),
            'maternal_surname'=> $request->input('maternal_surname'),
            'email'=> $request->input('email'),
            'phone'=> $request->input('phone'),
            'password'=> password_hash($request->input('password'), PASSWORD_BCRYPT),
        ];
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $destination_folder = $_SERVER['DOCUMENT_ROOT'] . '/public/files/users/image/';
            // Verifica si la carpeta existe, si no, la crea
            if (!file_exists($destination_folder)) {
                mkdir($destination_folder, 0777, true);
            }

            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png'
            ];

            if ($image['type'] == "image/jpeg" || $image['type'] == 'image/png') {
                $name_image = 'user-' . date('YmdHis') . '.' . $allowedTypes[$image['type']];
                move_uploaded_file($image['tmp_name'], $destination_folder . $name_image);
                $url_image_server = $_ENV['APP_URL'] . '/files/users/image/' . $name_image;
                $data['profile_photo_url'] = $url_image_server;
            }
        }
        $user = User::create($data);
        $response = [
            'message' => 'User created successfully',
            'user' => $user
        ];
        echo json_encode($response);
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
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $destination_folder = $_SERVER['DOCUMENT_ROOT'] . '/public/files/users/image/';
            // Verifica si la carpeta existe, si no, la crea
            if (!file_exists($destination_folder)) {
                mkdir($destination_folder, 0777, true);
            }

            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png'
            ];

            if ($image['type'] == "image/jpeg" || $image['type'] == 'image/png') {
                $name_image = 'user-' . date('YmdHis') . '.' . $allowedTypes[$image['type']];
                move_uploaded_file($image['tmp_name'], $destination_folder . $name_image);
                $url_image_server = $_ENV['APP_URL'] . '/files/users/image/' . $name_image;
                $data['profile_photo_url'] = $url_image_server;
            }
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
