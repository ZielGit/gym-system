<?php

namespace App\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
        return $this->view('admin.dashboard');
    }

    public function coach()
    {
        return $this->view('admin.coach.index');
    }

    public function customer()
    {
        return $this->view('admin.customer.index');
    }

    public function user()
    {
        return $this->view('admin.user.index');
    }
}
