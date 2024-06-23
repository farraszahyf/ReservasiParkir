<?php

namespace App\Http\Controllers;

use App\Models\parkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;

class ParkirController extends Controller
{

    private $currentReservations = 0;
    private function countCurrentReservations()
{
    $this->currentReservations = Parkir::count();
}
public function store(Request $request)
{
    $this->countCurrentReservations();

    if ($this->currentReservations >= 15) {
        // Tampilkan pesan kesalahan atau redirect kembali ke halaman sebelumnya
        return redirect()->route('parkir.create')->with('error', 'Maaf, maksimal reservasi hari ini sudah habis. Silakan hubungi admin untuk menghapus data reservasi terlebih dahulu.');
    }

    $validatedData = $request->validate([
        'nama' => 'required|max:255',
        'nim' => 'required|numeric|unique:parkirs,nim',
        'plat' => 'required|string|max:255',
        'nama_motor' => 'required|max:255'
    ], [
        'nim.unique' => 'NIM sudah digunakan'
    ]);

    $number =  mt_rand(1000000000,9999999999);
    if ($this->productCodeExists($number)) {
        $number = mt_rand(1000000000,9999999999);
    }
    $validatedData['product_code'] = $number;

    $parkir = Parkir::create($validatedData);

    // Tambahkan 1 ke jumlah reservasi saat ini
    $this->currentReservations++;

    // Buat QR Code untuk product code baru
    $qrCodeHTML = DNS2D::getBarcodeHTML("$number", 'QRCODE');

    // Redirect ke halaman yang menampilkan QR code
    return redirect()->route('qr_code.show', ['product_code' => $parkir->product_code]);
}

public function showQRCode($product_code)
{
    // Buat QR Code HTML untuk product code
    $qrCodeHTML = DNS2D::getBarcodeHTML($product_code, 'QRCODE');

    // Tampilkan halaman yang menampilkan QR code
    return view('scan', ['product_code' => $product_code, 'qrCodeHTML' => $qrCodeHTML]);
}

    

    public function productCodeExists($number)
    {
        return Parkir::whereProductCode ($number)->exists();
    }

    public function create ()
    {
        return view ('create');
    }

    public function show ()
    {
        $parkirs = parkir::all();
        return view('admin', ['parkirs' => $parkirs]);
    }

    public function destroy($id)
    {
        $parkir = Parkir::findOrFail($id);
        $parkir->delete();
        return redirect()->route('parkir.show')->with('pesan', 'Data Parkir Berhasil Dihapus !');
    }

    public function index()
    {
        return view('admin');
    }

    public function landing()
    {
        return view ('landing');
    }
}
