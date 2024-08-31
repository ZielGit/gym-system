<?php

namespace App\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
        return $this->view('admin.dashboard');
    }

    public function customer()
    {
        return $this->view('admin.customer.index');
    }
}
