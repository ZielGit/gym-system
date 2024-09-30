<?php

namespace App\Controllers\Api;

use App\Middleware\AuthMiddleware;
use App\Models\Coach;
use Core\Request;

class CoachController
{
    public function __construct()
    {
        $auth = new AuthMiddleware();
        $auth->handle();
    }

    public function index()
    {
        $request = new Request;
        $coaches = Coach::search($request->input('search'))->get();
        echo json_encode($coaches);
    }

    public function store()
    {
        $request = new Request;
        $coach = Coach::create($request->all());
        $data = [
            'message' => 'Coach created successfully',
            'coach' => $coach
        ];
        echo json_encode($data);
    }

    public function show($id)
    {
        $coach = Coach::find($id);
        echo json_encode($coach);
    }

    public function update($id)
    {
        $request = new Request;
        $coach = Coach::find($id);
        $coach->update($request->all());
        $data = [
            'message' => 'Coach updated successfully',
            'coach' => $coach
        ];
        echo json_encode($data);
    }

    public function updateStatus($id)
    {
        $request = new Request;
        $coach = Coach::find($id);
        $coach->update([
            'status' => $request->input('status')
        ]);
        $data = [
            'message' => 'Coach status updated successfully',
            'coach' => $coach
        ];
        echo json_encode($data);
    }
}
