<?php

namespace App\Controllers\Api;

use App\Middleware\AuthMiddleware;
use App\Models\Coach;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\PlanDetails;
use App\Models\User;
use Core\Request;

class DashboardController
{
    public function __construct()
    {
        $auth = new AuthMiddleware();
        $auth->handle();
        date_default_timezone_set('America/Lima');
    }

    public function index()
    {
        $coaches = Coach::count();
        $customers = Customer::count();
        $plans = Plan::count();
        $users = User::count();
        $response = [
            'coaches' => $coaches,
            'customers' => $customers,
            'plans' => $plans,
            'users' => $users
        ];
        echo json_encode($response);
    }

    public function productsSold($id)
    {
        $request = new Request;
        $desde = $request->input('anio') . '-01-01';
        $hasta = $request->input('anio') . '-12-31';
        $productsSold = Payment::selectRaw("
            SUM(IF(MONTH(date) = 1, price, 0)) AS ene,
            SUM(IF(MONTH(date) = 2, price, 0)) AS feb,
            SUM(IF(MONTH(date) = 3, price, 0)) AS mar,
            SUM(IF(MONTH(date) = 4, price, 0)) AS abr,
            SUM(IF(MONTH(date) = 5, price, 0)) AS may,
            SUM(IF(MONTH(date) = 6, price, 0)) AS jun,
            SUM(IF(MONTH(date) = 7, price, 0)) AS jul,
            SUM(IF(MONTH(date) = 8, price, 0)) AS ago,
            SUM(IF(MONTH(date) = 9, price, 0)) AS sep,
            SUM(IF(MONTH(date) = 10, price, 0)) AS oct,
            SUM(IF(MONTH(date) = 11, price, 0)) AS nov,
            SUM(IF(MONTH(date) = 12, price, 0)) AS dic
        ")
        ->whereBetween('date', [$desde, $hasta])
        ->where('user_id', $id)
        ->first();
        echo json_encode($productsSold);
    }

    public function sales($id)
    {
        $fechaHoy = date('Y-m-d');

        $data = PlanDetails::where('date', $fechaHoy) // Filtrar por la fecha actual
            ->where('plan_details.status', 1)
            ->where('user_id', $id)
            ->join('plans', 'plan_details.plan_id', '=', 'plans.id') // Hacer el join con la tabla plans
            ->select('plan_details.plan_id', 'plan_details.date', 'plan_details.status', 'plan_details.user_id', 'plans.id', 'plans.name')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('plan_details.plan_id')
            ->get();

        echo json_encode($data);
    }
}
