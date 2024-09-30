<?php

namespace App\Controllers\Api;

use App\Middleware\AuthMiddleware;
use App\Models\Attendance;
use Core\Request;

class AttendanceController
{
    public function __construct()
    {
        $auth = new AuthMiddleware();
        $auth->handle();
        date_default_timezone_set('America/Lima');
    }

    public function index()
    {
        $attendances = Attendance::with(['customer', 'coach', 'routine'])->get();
        echo json_encode($attendances);
    }

    public function store()
    {
        $request = new Request;
        $attendance = Attendance::create([
            'customer_id' => $request->input('customer_id'),
            'date' => date("Y-m-d"),
            'check_in_time' => date("Y-m-d H:i:s"),
            'coach_id' => $request->input('coach_id'),
            'routine_id' => $request->input('routine_id'),
            'user_id' => $request->input('user_id'),
        ]);
        $data = [
            'message' => 'Attendance created successfully',
            'attendance' => $attendance
        ];
        echo json_encode($data);
    }

    public function show($id)
    {
        $attendance = Attendance::with(['customer', 'coach', 'routine'])->find($id);
        echo json_encode($attendance);
    }

    public function update($id)
    {
        $request = new Request;
        $attendance = Attendance::find($id);
        $attendance->update($request->all());
        $data = [
            'message' => 'Attendance updated successfully',
            'attendance' => $attendance
        ];
        echo json_encode($data);
    }

    public function updateStatus($id)
    {
        $attendance = Attendance::find($id);
        $attendance->update([
            'check_out_time' => date("Y-m-d H:i:s"),
            'status' => 0
        ]);
        $data = [
            'message' => 'Attendance status updated successfully',
            'attendance' => $attendance
        ];
        echo json_encode($data);
    }
}
