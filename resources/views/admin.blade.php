@extends('layouts.app')

@section('content')

@php
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;
@endphp

<div class="container">
<h1>Data Parkiran</h1>
@if (session('pesan'))
    <div class="alert alert-danger">
        {{ session('pesan') }}
    </div>
        @endif

<!-- Tabel -->

<table class ="table table-striped table-dark table-hover">
    <thead class ="thead-dark">
        <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Nama</th>
            <th scope="col" class="text-center">NIM</th>
            <th scope="col" class="text-center">Plat Nomor</th>
            <th scope="col" class="text-center">Barcode</th>
            <th scope="col" class="text-center">Merk Motor</th>
            <th scope="col" class="text-center">Aksi</th>
</tr>
</thead>

<tbody class="table-bordered">

    @forelse ($parkirs as $parkir)
    <tr>
        <th scope="row" class="table-light text-center">{{$loop->iteration}}</th>
        <th scope="row" class="table-light text-center">{{$parkir->nama}}</th>
        <th scope="row" class="table-light text-center">{{$parkir->nim}}</th>
        <th scope="row" class="table-light text-center">{{$parkir->plat}}</th>
        <th scope="row" class="table-light text-center">{{$parkir->product_code}}</th>
        <th scope="row" class="table-light text-center">{{$parkir->nama_motor}}</th>
        <th scope="row" class="table-light text-center">
        <form action="{{ route ('delete', ['id' => $parkir->id])}}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-sm btn-danger mb-1"><i class="fas fa-trash"></i> Delete</button>
        </form>
        </th>
        @empty
        <td colspan="6" class="text-center">Tidak ada Data</td>
        @endforelse
    </tbody>
    </table>

@endsection
