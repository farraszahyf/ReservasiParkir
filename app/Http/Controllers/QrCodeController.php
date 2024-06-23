<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use App\Models\Parkir;


class QrCodeController extends Controller
{
    public function show($product_code)
    {
        $qrCode = new QrCode($product_code);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Encode QR code as base64 string
        $base64QrCode = 'data:image/png;base64,' . base64_encode($result->getString());

        return view('qr-code.show', compact('base64QrCode'));
    }
}
