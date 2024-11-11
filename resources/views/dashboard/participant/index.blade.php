@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Manajemen Peserta Umrah</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <!-- Tambahkan dropdown filter untuk paket -->
                                    <select id="filter-package" class="form-select">
                                        <option value="">Semua Paket</option>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->nama_paket }}">{{ $package->nama_paket }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <a class="btn app-btn-primary" href="/dashboard/participant/create">
                                        Tambah Peserta Baru
                                    </a>
                                </div>
                            </div><!--//row-->
                        </div><!--//table-utilities-->
                    </div><!--//col-auto-->
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div><!--//row-->
                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive p-4">
                                    <table id="example" class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">No.</th>
                                                <th class="cell">NIK</th>
                                                <th class="cell">Nama Peserta</th>
                                                <th class="cell">Nomor Telp.</th>
                                                <th class="cell">Alamat</th>
                                                <th class="cell">Paket</th>
                                                <th class="cell">Foto KTP</th>
                                                <th class="cell">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($participants as $key => $participant)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $participant->nik }}</td>
                                                    <td>{{ $participant->nama }}</td>
                                                    <td>{{ $participant->no_tlp }}</td>
                                                    <td>{{ $participant->alamat }}</td>
                                                    <td>{{ $participant->package->nama_paket ?? '-' }}</td>
                                                    <td>
                                                        @if ($participant->foto_ktp)
                                                            <a href="{{ url('foto_ktp/' . $participant->foto_ktp) }}"
                                                                download>
                                                                <img src="{{ url('foto_ktp/' . $participant->foto_ktp) }}"
                                                                    alt="Foto KTP" style="width: 100px; height: auto;">
                                                            </a>
                                                        @else
                                                            No file
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="/dashboard/participant/{{ $participant->id }}/edit"
                                                            class="btn btn-sm btn-warning">Ubah</a>
                                                        <form action="/dashboard/participant/{{ $participant->id }}"
                                                            method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger text-white"
                                                                onclick="return confirm('Anda yakin untuk menghapus data ini?')">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            var table = $('#example').DataTable();
            
            // Event listener untuk filter paket
            $('#filter-package').on('change', function() {
                var packageName = this.value;

                // Terapkan filter berdasarkan nama paket
                table
                    .columns(5) // Kolom paket berada di indeks 5
                    .search(packageName)
                    .draw();
            });
        });
    </script>
@endsection
