<?php

namespace App\Controllers\Api;

use App\Models\Coach;
use App\Models\Customer;

class HomeController
{
    public function index()
    {
        $customers = Customer::count();
        $coaches = Coach::count();
        $data = [
            'customers' => $customers,
            'coaches' => $coaches
        ];
        echo json_encode($data);
    }
}
