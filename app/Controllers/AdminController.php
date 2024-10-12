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

    public function customerPlan()
    {
        return $this->view('admin.customer.plan');
    }

    public function customerPayment()
    {
        return $this->view('admin.customer.payment');
    }

    public function user()
    {
        return $this->view('admin.user.index');
    }

    public function userProfile()
    {
        return $this->view('admin.user.profile');
    }

    public function plan()
    {
        return $this->view('admin.plan.index');
    }

    public function routine()
    {
        return $this->view('admin.routine.index');
    }

    public function attendance()
    {
        return $this->view('admin.attendance.index');
    }

    public function company()
    {
        return $this->view('admin.company.index');
    }
}
