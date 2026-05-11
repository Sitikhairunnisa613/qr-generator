<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Invoice;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

//HOME
Route::get('/', function () {
    return view('welcome');
});

//QR GENERATOR
Route::get('/qr', function (Request $request) {

    $data = $request->query('data');

    if (!$data) {
        return 'Data kosong';
    }

    return response(
        QrCode::size(300)->generate($data)
    )->header('Content-Type', 'image/svg+xml');
});

//SCAN PAYMENT
Route::get('/scan/payment/{id}', function ($id, Request $request) {

    $nominal = $request->query('nominal');

    $payment = Invoice::where('invoice_id', $id)->first();

    if (!$payment) {

        $payment = Invoice::create([
            'invoice_id' => $id,
            'nominal' => $nominal ?? 0,
            'status' => 'PENDING'
        ]);
    }

    return view('payment', compact('payment'));
});

//MARK AS PAID


Route::get('/payment/paid/{id}', function ($id) {

    $payment = Invoice::where('invoice_id', $id)->first();

    if (!$payment) {
        return 'Payment tidak ditemukan';
    }

    $payment->update([
        'status' => 'PAID'
    ]);

    return redirect("/scan/payment/{$id}?nominal={$payment->nominal}");
});