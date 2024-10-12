<?php

namespace App\Controllers\Api;

use App\Middleware\AuthMiddleware;
use App\Models\Company;
use Core\Request;

class CompanyController
{
    public function __construct()
    {
        $auth = new AuthMiddleware();
        $auth->handle();
    }

    public function show($id)
    {
        $company = Company::find($id);
        echo json_encode($company);
    }

    public function update($id)
    {
        $request = new Request;
        
        $data = [
            'ruc' => $request->input('ruc'),
            'name' => $request->input('name'),
            'tax_domicile' => $request->input('tax_domicile'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ];

        $company = Company::find($id);

        if ($request->hasFile('logo_path')) {
            $image = $request->file('logo_path');
            $destination_folder = $_SERVER['DOCUMENT_ROOT'] . '/public/files/companies/image/';
            // Verifica si la carpeta existe, si no, la crea
            if (!file_exists($destination_folder)) {
                mkdir($destination_folder, 0777, true);
            }

            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png'
            ];

            if ($image['type'] == "image/jpeg" || $image['type'] == 'image/png') {
                $name_image = 'company-' . date('YmdHis') . '.' . $allowedTypes[$image['type']];
                move_uploaded_file($image['tmp_name'], $destination_folder . $name_image);
                $url_image_server = $_ENV['APP_URL'] . '/files/companies/image/' . $name_image;
                $data['logo_path'] = $url_image_server;
            }
        }
        $company->update($data);
        $response = [
            'message' => 'Company updated successfully',
            'company' => $company
        ];
        echo json_encode($response);
    }
}
