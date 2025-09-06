@extends('layouts.admin')

@section('title', 'Data Mobil')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="#" class="btn btn-primary">Tambah Mobil</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Nama Mobil</th>
                            <th>Merek</th>
                            <th>Harga Lepas Kunci</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Data mobil akan ditampilkan di sini --}}
                        <tr>
                            <td colspan="6" class="text-center">Data belum tersedia.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection