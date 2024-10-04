<?php

namespace App\Controllers\Api;

use App\Middleware\AuthMiddleware;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\PlanDetails;
use Core\Request;

class PaymentController
{
    public function __construct()
    {
        $auth = new AuthMiddleware();
        $auth->handle();
    }

    public function index()
    {
        $payments = Payment::with(['customer', 'plan'])->get();
        echo json_encode($payments);
    }

    public function store()
    {
        $request = new Request;
        $date = date("Y-m-d");
        $planDetails = PlanDetails::find($request->input('plan_detail_id'));
        if ($planDetails->plan->condition == 'MENSUAL') {
            $due_date = date("Y-m-d", strtotime($planDetails->due_date . '+1 month'));
        }else { // ANUAL
            $due_date = date("Y-m-d", strtotime($planDetails->due_date . '+1 year'));
        }
        $planDetails->update([
            'due_date' => $due_date,
        ]);
        $payment = Payment::create([
            'plan_detail_id' => $request->input('plan_detail_id'),
            'customer_id' => $planDetails->customer_id,
            'plan_id' => $planDetails->plan_id,
            'price' => $planDetails->plan->price,
            'date' => $date,
            'hour' => date("Y-m-d H:i:s"),
            'user_id' => $request->input('user_id'),
        ]);
        $data = [
            'message' => 'Payment created successfully',
            'payment' => $payment
        ];
        echo json_encode($data);
    }
}
