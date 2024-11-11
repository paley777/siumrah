@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Sistem Transaksi</h1>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            </div><!--//row-->
                        </div><!--//table-utilities-->
                    </div><!--//col-auto-->
                </div><!--//row-->
                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="row">
                            <div class="col-sm-12 col-lg-8">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-header px-4 py-3">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-12  col-lg-auto text-center text-lg-start">
                                                <div class="app-icon-holder">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                        class="bi bi-receipt" fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                                        <path fill-rule="evenodd"
                                                            d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                                    </svg>
                                                </div><!--//app-icon-holder-->
                                            </div><!--//col-->
                                            <div class="col-12 col-lg-6 text-center text-lg-start">
                                                <div class="notification-type mb-2"><span
                                                        class="badge bg-primary">Transaksi</span></div>
                                                <h4 class="notification-title mb-1">Keranjang</h4>
                                                <ul class="notification-meta list-inline mb-0">
                                                    <li class="list-inline-item">Create</li>
                                                    <li class="list-inline-item">|</li>
                                                    <li class="list-inline-item">System</li>
                                                </ul>
                                            </div><!--//col-->
                                            <div class="d-flex ms-auto col-12 col-lg-auto justify-content-center">
                                                <button class="btn app-btn-primary" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#editModal">
                                                    <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M13 3C13 2.44772 12.5523 2 12 2C11.4477 2 11 2.44772 11 3V11H3C2.44772 11 2 11.4477 2 12C2 12.5523 2.44772 13 3 13H11V21C11 21.5523 11.4477 22 12 22C12.5523 22 13 21.5523 13 21V13H21C21.5523 13 22 12.5523 22 12C22 11.4477 21.5523 11 21 11H13V3Z"
                                                                fill="#ffffff"></path>
                                                        </g>
                                                    </svg>
                                                    Tambah Perlengkapan Umrah
                                                </button>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                    </div><!--//app-card-header-->
                                    <div class="app-card-body">
                                        <form class="row g-2" method="post" action="/dashboard/transaction">
                                            @csrf
                                            <div class="table-responsive p-4"
                                                style="overflow-x: auto; white-space: nowrap;">
                                                <table id="example1" class="table app-table-hover mb-0 text-left"
                                                    style="table-layout: fixed;">
                                                    <thead>
                                                        <tr>
                                                            <th class="cell" style="width: 150px;">Nama Barang</th>
                                                            <th class="cell" style="width: 50px;">Satuan</th>
                                                            <th class="cell" style="width: 30px;">Stok</th>
                                                            <th class="cell" style="width: 70px;">Qty</th>
                                                            <th class="cell" style="width: 30px;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data rows will be inserted here dynamically -->
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div><!--//app-card-body-->
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-header px-4 py-3">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-12 col-lg-auto text-center text-lg-start">
                                                <div class="app-icon-holder">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                        class="bi bi-receipt" fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                                        <path fill-rule="evenodd"
                                                            d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                                    </svg>
                                                </div><!--//app-icon-holder-->
                                            </div><!--//col-->
                                            <div class="col-12 col-lg-auto text-center text-lg-start">
                                                <div class="notification-type mb-2"><span
                                                        class="badge bg-primary">Transaksi</span></div>
                                                <h4 class="notification-title mb-1">Formulir Transaksi Baru</h4>
                                                <ul class="notification-meta list-inline mb-0">
                                                    <li class="list-inline-item">Create</li>
                                                    <li class="list-inline-item">|</li>
                                                    <li class="list-inline-item">System</li>
                                                </ul>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                    </div><!--//app-card-header-->
                                    <div class="app-card-body p-4">
                                        <div class="row g-1">
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label ">Petugas<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="nama_petugas"
                                                    value="{{ Auth::user()->name }}" readonly required>
                                            </div>
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label ">Kode Invoice<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="kode_inv"
                                                    value="{{ $kode_inv }}" readonly required>
                                            </div>
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label">Nama Peserta
                                                    Umrah<span class="text-danger">*</span></label>
                                                <select class="form-select select2" name="participant_id"
                                                    id="participant-select" required>
                                                    <option value="">Pilih Peserta Umrah</option>
                                                    @foreach ($participants as $participant)
                                                        <option value="{{ $participant->id }}|{{ $participant->nama }}"
                                                            data-package-id="{{ $participant->package_id }}">
                                                            {{ $participant->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label ">Status<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="status" required>
                                                    <option value="">Pilih Status</option>
                                                    <option value="DITERIMA">DITERIMA</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 position-relative">
                                                <label for="validationCustom01" class="form-label">Keterangan<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="keterangan"
                                                    placeholder="Isi Keterangan" value="-">
                                            </div>
                                        </div>
                                        <p>
                                            (Wajib terisi untuk kolom dengan tanda "<span class="text-danger">*</span>").
                                        </p>
                                    </div><!--//app-card-body-->
                                    <div class="app-card-footer px-4 py-3">
                                        <button class="btn app-btn-primary" type="submit">
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M20 4L3 9.31372L10.5 13.5M20 4L14.5 21L10.5 13.5M20 4L10.5 13.5"
                                                        stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </path>
                                                </g>
                                            </svg> Simpan Transaksi
                                        </button>
                                        </form>
                                    </div><!--//app-card-footer-->
                                </div>
                            </div>
                        </div>
                    </div><!--//app-card-->
                </div><!--//tab-pane-->
            </div><!--//tab-content-->
        </div><!--//container-fluid-->
    </div><!--//app-content-->
    </div><!--//app-wrapper-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        $(document).ready(function() {
            $('#example1').DataTable();
        });
    </script>
    <div class="modal fade" id="modalSukses" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transaksi Sukses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Perlengkapan Umrah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive p-4">
                        <table id="example" class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">No.</th>
                                    <th class="cell">Nama Barang</th>
                                    <th class="cell">Satuan</th>
                                    <th class="cell">Stok</th>
                                    <th class="cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $key => $inventory)
                                    @if ($inventory->stok != 0)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $inventory->nama_barang }}</td>
                                            <td>{{ $inventory->satuan }}</td>
                                            <td>{{ $inventory->stok }}</td>
                                            <td><button class="btn app-btn-primary tambah-ke-keranjang" type="button"
                                                    data-nama_barang="{{ $inventory->nama_barang }}"
                                                    data-satuan="{{ $inventory->satuan }}"
                                                    data-stok="{{ $inventory->stok }}" ">Tambah Perlengkapan Umrah
                                                                                    </button>
                                                                                        </td>
                                                                                    </tr>
     @endif
                                    @endforeach
                            </tbody>
                        </table>
                    </div><!--//table-responsive-->
                </div>
            </div>
        </div>
    </div>
    <script>
        function escapeHtml(text) {
            return text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        $(document).ready(function() {
            var table = $('#example1').DataTable();
            table.page.len(100).draw();

            $(document).on('click', '.tambah-ke-keranjang', function() {
                // Mengambil data
                var nama_barang = $(this).data("nama_barang");
                var satuan = $(this).data("satuan");
                var stok = $(this).data("stok");
                var qty = 0; // Default qty
                // Gunakan escapeHtml untuk mengamankan karakter spesial
                var escapedNamaBarang = escapeHtml(nama_barang);

                var data = [
                    ['<input type="text" class="form-control" name="nama_barang[]" value="' +
                        escapedNamaBarang + '" readonly>', satuan, stok,
                        '<input type="number" class="form-control qty" name="qty[]" min="1" value="' +
                        qty + '">', // Ganti `id="inp1"` dengan class
                        '<button class="btn btn-sm btn-danger text-white hapus-baris"><svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M14 10V17M10 10V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button>'
                    ]
                ];

                var tableRow = table.rows.add(data).draw().node();
            });

            $(document).on('click', '.hapus-baris', function() {
                var table = $('#example1').DataTable();
                var row = $(this).closest('tr');
                table.row(row).remove().draw();
            });

            // Event listener untuk qty untuk membatasi nilai
            $(document).on('input', '.qty', function() {
                var row = $(this).closest('tr');
                var qty = parseInt($(this).val());
                var stok = parseInt(row.find('td:eq(2)').text().replace(/[^0-9]/g, ''));

                // Batasi qty hingga maksimum stok yang tersedia
                if (qty > stok) {
                    $(this).val(stok); // Set qty ke stok maksimum jika melebihi
                } else if (qty < 1 || isNaN(qty)) {
                    $(this).val(1); // Set minimum qty ke 1
                }
            });
        });
    </script>

    <script>
        document.getElementById("inp1").addEventListener("change", function() {
            let v = parseInt(this.value);
            if (v < 1) this.value = 1;
        });
        $("#inp1").on("input", function() {
            if (/^0/.test(this.value)) {
                this.value = this.value.replace(/^0/, "1")
            }
        })
    </script>
    <!-- Script JavaScript untuk menampilkan modal -->
    @if (session('success'))
        <script>
            $(document).ready(function() {
                $('#modalSukses').modal('show');
                $('#successMessage').text("{{ session('success') }}");
            });
        </script>
    @endif
    <script>
        // Fetch participant package items on selection
        $('#participant-select').on('change', function() {
            const participantId = $(this).val();
            const packageId = $(this).find(':selected').data('package-id');

            if (packageId) {
                // Clear existing cart items
                const table = $('#example1').DataTable();
                table.clear().draw();

                // Get the package items
                const packageItems = @json($packages->keyBy('id'));

                if (packageItems[packageId]) {
                    let insufficientStockItems = [];

                    packageItems[packageId].inventories.forEach(item => {
                        let qty = item.pivot.quantity;
                        let availableStock = item.stok;

                        if (qty > availableStock) {
                            qty = 0;
                            insufficientStockItems.push(item
                                .nama_barang); // Store item with insufficient stock
                        }

                        const rowData = [
                            `<input type="text" class="form-control" name="nama_barang[]" value="${item.nama_barang}" readonly>`,
                            item.satuan,
                            availableStock,
                            `<input type="number" class="form-control qty" name="qty[]" min="0" value="${qty}" max="${availableStock}">`,
                            '<button class="btn btn-sm btn-danger text-white hapus-baris">Hapus</button>'
                        ];

                        table.row.add(rowData).draw();
                    });

                    // Show modal if there are items with insufficient stock
                    if (insufficientStockItems.length > 0) {
                        const itemList = insufficientStockItems.join(', ');
                        $('#insufficientStockModal .modal-body').text(
                            `Stok barang berikut tidak mencukupi: ${itemList}. Barang tersebut diset ke kuantitas 0.`
                        );
                        $('#insufficientStockModal').modal('show');
                    }
                }
            }
        });

        // Handle removing rows from the table
        $(document).on('click', '.hapus-baris', function() {
            const table = $('#example1').DataTable();
            table.row($(this).closest('tr')).remove().draw();
        });

        // Modal for insufficient stock
        document.body.insertAdjacentHTML('beforeend', `
            <div class="modal fade" id="insufficientStockModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Stok Tidak Mencukupi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"></div>
                    </div>
                </div>
            </div>
        `);
    </script>
    <script>
        $(document).ready(function() {
            // Intercept form submission
            $('form').on('submit', function(event) {
                // Check if there are any items in the "nama_barang[]" fields
                const itemCount = $("input[name='nama_barang[]']").length;

                if (itemCount === 0) {
                    // Prevent form submission
                    event.preventDefault();

                    // Show the empty cart modal
                    $('#emptyCartModal').modal('show');
                }
            });

            // Initialize select2 for participant selection
            $('.select2').select2({
                placeholder: "Select a participant",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

    <div class="modal fade" id="emptyCartModal" tabindex="-1" aria-labelledby="emptyCartModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emptyCartModalLabel">Peringatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Silakan tambahkan setidaknya satu barang ke keranjang sebelum melanjutkan transaksi.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection
