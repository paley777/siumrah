@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Invoice</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

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
                                    <table border="0" cellspacing="5" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td>Minimum date:</td>
                                                <td><input type="text" id="min" name="min"></td>
                                            </tr>
                                            <tr>
                                                <td>Maximum date:</td>
                                                <td><input type="text" id="max" name="max"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table id="example" class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">No.</th>
                                                <th class="cell">Created_At</th>
                                                <th class="cell">Kode Invoice</th>
                                                <th class="cell">Tanggal</th>
                                                <th class="cell">Petugas</th>
                                                <th class="cell">Peserta Umrah</th>
                                                <th class="cell">Nama Paket</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $key => $transaction)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $transaction->created_at }}</td>
                                                    <td>{{ $transaction->kode_inv }}</td>
                                                    <td>{{ $transaction->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                                                    <td>{{ $transaction->nama_petugas }}</td>
                                                    <td>{{ $transaction->nama_peserta }}</td>
                                                    <td>{{ $transaction->participant->package->nama_paket ?? 'Tidak Memiliki Paket' }}
                                                    </td>
                                                    <td>{{ $transaction->status }}</td>
                                                    <td>{{ $transaction->keterangan }}</td>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
    <script>
        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[1]);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });

            // DataTables initialisation
            var table = $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible',
                        },

                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, 'colvis'
                ]

            });

            // Refilter the table
            $('#min, #max').on('change', function() {
                table.draw();
            });

            // Tambahkan event listener untuk perubahan pada tabel
            table.on('draw', function() {
                var totalProfit = calculateTotalProfit();
                var formattedTotalProfit = totalProfit.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
                $('#totalProfit').text(formattedTotalProfit);
            });

            function calculateTotalProfit() {
                var totalProfit = 0;
                table.rows().every(function() {
                    var data = this.data();
                    var date = new Date(data[1]);
                    var min = minDate.val() ? new Date(minDate.val()) : null;
                    var max = maxDate.val() ? new Date(maxDate.val()) : null;

                    // Cek apakah tanggal dalam rentang yang dipilih
                    if ((!min || date >= min) && (!max || date <= max)) {
                        if (data[10]) {
                            var profit = parseFloat(data[10].replace(/[^\d]/g, ''));
                            totalProfit += profit;
                        }
                    }
                });
                return totalProfit;
            }
        });
    </script>
@endsection
