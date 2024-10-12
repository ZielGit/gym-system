<?php

use App\Controllers\Api\AttendanceController;
use App\Controllers\Api\AuthController;
use App\Controllers\Api\CoachController;
use App\Controllers\Api\CompanyController;
use App\Controllers\Api\CustomerController;
use App\Controllers\Api\DashboardController;
use App\Controllers\Api\HomeController;
use App\Controllers\Api\PaymentController;
use App\Controllers\Api\PlanController;
use App\Controllers\Api\RoutineController;
use App\Controllers\Api\UserController;

return function ($router) {
    $router->addRoute('GET', '/home', [HomeController::class, 'index']);
    $router->addRoute('GET', '/home/logo/{id:\d+}', [HomeController::class, 'logo']);

    // Auth
    $router->addRoute('POST', '/login', [AuthController::class, 'login']);
    $router->addRoute('GET', '/logout', [AuthController::class, 'logout']);

    // Customers
    $router->addRoute('GET', '/customers', [CustomerController::class, 'index']);
    $router->addRoute('POST', '/customers', [CustomerController::class, 'store']);
    $router->addRoute('GET', '/customers/{id:\d+}', [CustomerController::class, 'show']);
    $router->addRoute('PUT', '/customers/{id:\d+}', [CustomerController::class, 'update']);
    $router->addRoute('PUT', '/customers/status/{id:\d+}', [CustomerController::class, 'updateStatus']);
    $router->addRoute('GET', '/customers/plan', [CustomerController::class, 'plan']);
    $router->addRoute('GET', '/customers/payments/{id:\d+}', [CustomerController::class, 'payments']);

    // Coaches
    $router->addRoute('GET', '/coaches', [CoachController::class, 'index']);
    $router->addRoute('POST', '/coaches', [CoachController::class, 'store']);
    $router->addRoute('GET', '/coaches/{id:\d+}', [CoachController::class, 'show']);
    $router->addRoute('PUT', '/coaches/{id:\d+}', [CoachController::class, 'update']);
    $router->addRoute('PUT', '/coaches/status/{id:\d+}', [CoachController::class, 'updateStatus']);

    // Users
    $router->addRoute('GET', '/users', [UserController::class, 'index']);
    $router->addRoute('POST', '/users', [UserController::class, 'store']);
    $router->addRoute('GET', '/users/{id:\d+}', [UserController::class, 'show']);
    $router->addRoute('PUT', '/users/{id:\d+}', [UserController::class, 'update']);
    $router->addRoute('PUT', '/users/status/{id:\d+}', [UserController::class, 'updateStatus']);
    $router->addRoute('PUT', '/users/password/{id:\d+}', [UserController::class, 'changePassword']);

    // Plans
    $router->addRoute('GET', '/plans', [PlanController::class, 'index']);
    $router->addRoute('POST', '/plans', [PlanController::class, 'store']);
    $router->addRoute('GET', '/plans/{id:\d+}', [PlanController::class, 'show']);
    $router->addRoute('POST', '/plans/{id:\d+}', [PlanController::class, 'update']);
    $router->addRoute('PUT', '/plans/status/{id:\d+}', [PlanController::class, 'updateStatus']);
    $router->addRoute('GET', '/plans/customer', [PlanController::class, 'indexPlanCustomer']);
    $router->addRoute('POST', '/plans/customer', [PlanController::class, 'storePlanCustomer']);
    $router->addRoute('GET', '/plans/customer/{id:\d+}', [PlanController::class, 'showPlanCustomer']);
    $router->addRoute('PUT', '/plans/customer/details/{id:\d+}', [PlanController::class, 'updateStatusPlanCustomer']);

    // Routines
    $router->addRoute('GET', '/routines', [RoutineController::class, 'index']);
    $router->addRoute('POST', '/routines', [RoutineController::class, 'store']);
    $router->addRoute('GET', '/routines/{id:\d+}', [RoutineController::class, 'show']);
    $router->addRoute('PUT', '/routines/{id:\d+}', [RoutineController::class, 'update']);
    $router->addRoute('PUT', '/routines/status/{id:\d+}', [RoutineController::class, 'updateStatus']);

    // Attendances
    $router->addRoute('GET', '/attendances', [AttendanceController::class, 'index']);
    $router->addRoute('POST', '/attendances', [AttendanceController::class, 'store']);
    $router->addRoute('GET', '/attendances/{id:\d+}', [AttendanceController::class, 'show']);
    $router->addRoute('PUT', '/attendances/{id:\d+}', [AttendanceController::class, 'update']);
    $router->addRoute('PUT', '/attendances/status/{id:\d+}', [AttendanceController::class, 'updateStatus']);

    // Payments
    $router->addRoute('GET', '/payments', [PaymentController::class, 'index']);
    $router->addRoute('POST', '/payments', [PaymentController::class, 'store']);
    $router->addRoute('POST', '/payments/plan/{id:\d+}', [PaymentController::class, 'storePayment']);

    // Dashboard
    $router->addRoute('GET', '/dashboard', [DashboardController::class, 'index']);
    $router->addRoute('GET', '/dashboard/products-sold/{id:\d+}', [DashboardController::class, 'productsSold']);
    $router->addRoute('GET', '/dashboard/sales/{id:\d+}', [DashboardController::class, 'sales']);

    // Companies
    $router->addRoute('GET', '/companies/{id:\d+}', [CompanyController::class, 'show']);
    $router->addRoute('POST', '/companies/{id:\d+}', [CompanyController::class, 'update']);
};