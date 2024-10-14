<?php

namespace App\Controllers\Api;

use App\Middleware\AuthMiddleware;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Payment;
use Config\Pdf;
use Core\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class CustomerController
{
    public function __construct()
    {
        $auth = new AuthMiddleware();
        $auth->handle();
    }

    public function index()
    {
        $request = new Request;
        $customers = Customer::search($request->input('search'))->get();
        echo json_encode($customers);
    }

    public function store()
    {
        $request = new Request;
        $customer = Customer::create($request->all());
        $data = [
            'message' => 'Customer created successfully',
            'customer' => $customer
        ];
        echo json_encode($data);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        echo json_encode($customer);
    }

    public function update($id)
    {
        $request = new Request;
        $customer = Customer::find($id);
        $customer->update($request->all());
        $data = [
            'message' => 'Customer updated successfully',
            'customer' => $customer
        ];
        echo json_encode($data);
    }

    public function updateStatus($id)
    {
        $request = new Request;
        $customer = Customer::find($id);
        $customer->update([
            'status' => $request->input('status')
        ]);
        $data = [
            'message' => 'Customer status updated successfully',
            'customer' => $customer
        ];
        echo json_encode($data);
    }

    public function plan()
    {
        $request = new Request;
        $customers = Customer::search($request->input('search'))
            ->with(['planDetails:id,customer_id,plan_id,due_date', 'planDetails.plan:id,name,price'])
            ->where('status', 1)
            ->get();
        echo json_encode($customers);
    }

    public function payments($id)
    {
        $payments = Payment::with('plan:id,name,price')->where('customer_id', $id)->get();
        echo json_encode($payments);
    }

    public function paymentPdf($id)
    {
        $payments = Payment::find($id);
        $company = Company::find(1);
        $datos_qr = $company->ruc . '|' . $payments->price . '|' .
            $payments->date . '|' . $payments->customer->document_type . '|'.
            $payments->customer->document_number . '|';

        // Generar el código QR usando endroid/qr-code
        $result = Builder::create()
            ->writer(new PngWriter()) // Definir el formato PNG
            ->data($datos_qr)         // Datos para el QR
            ->encoding(new Encoding('UTF-8')) // Codificación
            ->errorCorrectionLevel(ErrorCorrectionLevel::High) // Nivel de corrección de errores
            ->size(150)               // Tamaño del código QR
            ->margin(10)              // Margen del código QR
            ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->build();                // Construir el código QR

        // Convertir la imagen del código QR a Base64
        $qrCodeBase64 = base64_encode($result->getString());
        $data = [
            'payment' => $payments->load('customer', 'plan'),
            'company' => $company,
            'qr_code_base64' => $qrCodeBase64 // Pasamos el QR en base64 a la vista
        ];
        $pdf = new Pdf();
        $html = $pdf->loadView('admin.pdf.invoice', ['data' => $data]);
        $pdf->generate($html, 'invoice-' . $payments->id . '.pdf');
    }
}
