<?php

namespace App\Controllers\Api;

use App\Middleware\AuthMiddleware;
use App\Models\Routine;
use Core\Request;

class RoutineController
{
    public function __construct()
    {
        $auth = new AuthMiddleware();
        $auth->handle();
    }

    public function index()
    {
        $routines = Routine::all();
        echo json_encode($routines);
    }

    public function store()
    {
        $request = new Request;
        $routine = Routine::create($request->all());
        $data = [
            'message' => 'Routine created successfully',
            'routine' => $routine
        ];
        echo json_encode($data);
    }

    public function show($id)
    {
        $routine = Routine::find($id);
        echo json_encode($routine);
    }

    public function update($id)
    {
        $request = new Request;
        $routine = Routine::find($id);
        $routine->update($request->all());
        $data = [
            'message' => 'Routine updated successfully',
            'routine' => $routine
        ];
        echo json_encode($data);
    }

    public function updateStatus($id)
    {
        $request = new Request;
        $routine = Routine::find($id);
        $routine->update([
            'status' => $request->input('status')
        ]);
        $data = [
            'message' => 'Routine status updated successfully',
            'routine' => $routine
        ];
        echo json_encode($data);
    }
}
