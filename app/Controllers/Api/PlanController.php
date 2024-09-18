<?php

namespace App\Controllers\Api;

use App\Middleware\AuthMiddleware;
use App\Models\Plan;
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
        $plans = Plan::all();
        echo json_encode($plans);
    }

    public function store()
    {
        $request = new Request;
        $plan = Plan::create($request->all());
        $data = [
            'message' => 'Plan created successfully',
            'plan' => $plan
        ];
        echo json_encode($data);
    }

    public function show($id)
    {
        $plan = Plan::find($id);
        echo json_encode($plan);
    }

    public function update($id)
    {
        $request = new Request;
        $plan = Plan::find($id);
        $plan->update($request->all());
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
}
