<?php

namespace App\Controllers\Api;

use App\Middleware\AuthMiddleware;
use App\Models\Customer;
use Core\Request;

class CustomerController
{
    public function __construct()
    {
        $auth = new AuthMiddleware();
        $auth->handle();
    }

    public function index()
    {
        $customers = Customer::all();
        echo json_encode($customers);
    }

    public function store()
    {
        $request = new Request;
        $customer = Customer::create($request->all());
        echo json_encode($customer);
    }

    public function show()
    {
        $customer = Customer::all();
        echo json_encode($customer);
    }

    public function update($id)
    {
        $request = new Request;
        $customer = Customer::find($id);
        $customer->update($request->all());
        echo json_encode($customer);
    }

    public function updateStatus($id)
    {
        $request = new Request;
        $customer = Customer::find($id);
        $customer->update([
            'status' => $request->input('status')
        ]);
        echo json_encode($customer);
    }
}
