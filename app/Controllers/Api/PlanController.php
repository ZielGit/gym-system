<?php

namespace App\Controllers\Api;

use App\Middleware\AuthMiddleware;
use App\Models\Plan;
use App\Models\PlanDetails;
use Core\Request;

class PlanController
{
    public function __construct()
    {
        $auth = new AuthMiddleware();
        $auth->handle();
    }

    public function index()
    {
        $request = new Request;
        $plans = Plan::search($request->input('search'))->get();
        echo json_encode($plans);
    }

    public function store()
    {
        $request = new Request;

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'condition' => $request->input('condition'),
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destination_folder = $_SERVER['DOCUMENT_ROOT'] . '/public/files/plans/image/';
            // Verifica si la carpeta existe, si no, la crea
            if (!file_exists($destination_folder)) {
                mkdir($destination_folder, 0777, true);
            }

            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png'
            ];

            if ($image['type'] == "image/jpeg" || $image['type'] == 'image/png') {
                $name_image = 'plan-' . date('YmdHis') . '.' . $allowedTypes[$image['type']];
                move_uploaded_file($image['tmp_name'], $destination_folder . $name_image);
                $url_image_server = $_ENV['APP_URL'] . '/files/plans/image/' . $name_image;
                $data['image'] = $url_image_server;
            }
        }

        $plan = Plan::create($data);
        $response = [
            'message' => 'Plan created successfully',
            'plan' => $plan
        ];
        echo json_encode($response);
    }

    public function show($id)
    {
        $plan = Plan::find($id);
        echo json_encode($plan);
    }

    public function update($id)
    {
        $request = new Request;

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'condition' => $request->input('condition'),
        ];

        $plan = Plan::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destination_folder = $_SERVER['DOCUMENT_ROOT'] . '/public/files/plans/image/';
            // Verifica si la carpeta existe, si no, la crea
            if (!file_exists($destination_folder)) {
                mkdir($destination_folder, 0777, true);
            }

            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png'
            ];

            if ($image['type'] == "image/jpeg" || $image['type'] == 'image/png') {
                $name_image = 'plan-' . date('YmdHis') . '.' . $allowedTypes[$image['type']];
                move_uploaded_file($image['tmp_name'], $destination_folder . $name_image);
                $url_image_server = $_ENV['APP_URL'] . '/files/plans/image/' . $name_image;
                $data['image'] = $url_image_server;
            }
        }

        $plan->update($data);
        $data = [
            'message' => 'Plan updated successfully',
            'plan' => $plan
        ];
        echo json_encode($data);
    }

    public function updateStatus($id)
    {
        $request = new Request;
        $plan = Plan::find($id);
        $plan->update([
            'status' => $request->input('status')
        ]);
        $data = [
            'message' => 'Plan status updated successfully',
            'plan' => $plan
        ];
        echo json_encode($data);
    }

    public function indexPlanCustomer()
    {
        $planDetails = PlanDetails::with(['customer', 'plan'])->get();
        echo json_encode($planDetails);
    }

    public function storePlanCustomer()
    {
        $request = new Request;
        $date = date("Y-m-d");
        $plan = Plan::find($request->input('plan_id'));
        if ($plan->condition == 'MENSUAL') {
            $due_date = date("Y-m-d", strtotime($date . '+1 month'));
        }else { // ANUAL
            $due_date = date("Y-m-d", strtotime($date . '+1 year'));
        }
        $planDetails = PlanDetails::create([
            'customer_id'=> $request->input('customer_id'),
            'plan_id' => $request->input('plan_id'),
            'date' => $date,
            'hour' => date("Y-m-d H:i:s"),
            'due_date' => $due_date,
            'user_id' => $request->input('user_id'),
        ]);
        $data = [
            'message' => 'Client plan created successfully',
            'planDetails' => $planDetails
        ];
        echo json_encode($data);
    }
}
