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
                                    <a class="btn app-btn-primary" href="/dashboard/participant/create">
                                        <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M13 3C13 2.44772 12.5523 2 12 2C11.4477 2 11 2.44772 11 3V11H3C2.44772 11 2 11.4477 2 12C2 12.5523 2.44772 13 3 13H11V21C11 21.5523 11.4477 22 12 22C12.5523 22 13 21.5523 13 21V13H21C21.5523 13 22 12.5523 22 12C22 11.4477 21.5523 11 21 11H13V3Z"
                                                    fill="#ffffff"></path>
                                            </g>
                                        </svg>
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
                                                            class="btn btn-sm btn-warning"><svg width="16px"
                                                                height="16px" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <title></title>
                                                                    <g id="Complete">
                                                                        <g id="edit">
                                                                            <g>
                                                                                <path
                                                                                    d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8"
                                                                                    fill="none" stroke="#000000"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"></path>
                                                                                <polygon fill="none"
                                                                                    points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8"
                                                                                    stroke="#000000" stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"></polygon>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg> Ubah</a>
                                                        <form action="/dashboard/participant/{{ $participant->id }}"
                                                            method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger text-white"
                                                                onclick="return confirm('Anda yakin untuk menghapus data ini?')">
                                                                <svg width="16px" height="16px" viewBox="0 0 1024 1024"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                    </g>
                                                                    <g id="SVGRepo_iconCarrier">
                                                                        <path fill="#ffffff"
                                                                            d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z">
                                                                        </path>
                                                                    </g>
                                                                </svg> Hapus
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
            var table = $('#example').DataTable();
    
            // Event listener untuk menangkap input dari kotak pencarian umum
            $('#example_filter input').unbind().on('keyup', function() {
                var searchTerm = this.value;
    
                // Terapkan pencarian regex pada kolom "Paket" (kolom ke-6 dalam tabel, jadi indeks 5)
                table
                    .columns(5) // Kolom "Paket"
                    .search('\\b' + searchTerm + '\\b', true, false) // regex: true, smart: false
                    .draw();
            });
        });
    </script>
@endsection
