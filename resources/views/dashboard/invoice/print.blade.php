<html>

<head>
    <title>Invoice</title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }

        .note {
            text-align: left;
            margin-left: 50px;
            /* Reset margin-left */
        }
    </style>
    <style>
        .ttd td,
        .ttd th {
            padding-bottom: 4em;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:12pt;'>
    <center>
        <table style='width:1000px; font-size:12pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                <span style='font-size:12pt'><b>PT. BIM Wisata Tour & Travel</b></span></br>
                Jl. M.T. Haryono No.289, Kp. Bali, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu 38119</br>
                Telp : 0821-8366-1001
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                <b><span style='font-size:12pt'>INVOICE</span></b></br>
                No Invoice. : {{ $transaction->kode_inv }}</br>
                Tanggal : {{ $transaction->created_at->isoFormat('dddd, D MMMM Y') }}</br>
                {{ $transaction->status }}</br>
                Jatuh Tempo : {{ $transaction->jatuh_tempo }}</br>
            </td>
        </table>
        <table style='width:1000px; font-size:12pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                Kepada Yth. : {{ $transaction->nama_peserta }}</br>
                Alamat : {{ $peserta->alamat }} <br>
                No Telp :{{ $peserta->no_tlp }}
            </td>

        </table>
        <table cellspacing='0' style='width:1000px; font-size:12pt; font-family:calibri;  border-collapse: collapse;'
            border='1'>
            <tbody>
                <tr align='center'>
                    <td width='60%'>Nama Barang</td>
                    <td width='20%'>Qty</td>
                </tr>
                <tr>
                    @foreach ($orders as $order)
                        <td>{{ $order->nama_barang }}</td>
                        <td>{{ $order->qty }}</td>
                    @endforeach
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>Keterangan</td>
                    <td colspan="3">{{ $transaction->keterangan }}</td>
                </tr>
                <tr>
                    <td>Barang Diterima Tanggal</td>
                    <td colspan="3"></td>
                </tr>
                <tr class="ttd">
                    <th colspan="1">Penerima</th>
                    <th colspan="2">Disetujui</th>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center;">{{ $transaction->nama_peserta }}</td>

                    <td colspan="2" style="text-align: center;">{{ $transaction->nama_petugas }}</td>
                </tr>
            </tfoot>
        </table>
        <div class="note" style="margin-left: 2px; margin-top: 10px;">
            <p>Note:</p>
            <p>1. Barang tersebut telah dikirim dalam keadaan baik dan cukup.</p>
            <p>2. Barang yang telah diterima tidak dapat ditukar atau dikembalikan tanpa persetujuan kami.</p>
        </div>
    </center>
</body>

</html>
<script>
    window.onload = function() {
        window.print();
    }
</script>
