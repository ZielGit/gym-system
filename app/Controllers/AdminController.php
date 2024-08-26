<?php

namespace App\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
        return $this->view('admin.dashboard');
    }
}
