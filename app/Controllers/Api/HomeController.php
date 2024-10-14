<?php

namespace App\Controllers\Api;

use App\Models\Coach;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Plan;

class HomeController
{
    public function index()
    {
        $customers = Customer::count();
        $coaches = Coach::count();
        $plans = Plan::get();
        $data = [
            'customers' => $customers,
            'coaches' => $coaches,
            'plans' => $plans
        ];
        echo json_encode($data);
    }

    public function logo($id)
    {
        $company = Company::find($id);
        echo json_encode($company);
    }
}
