<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Participant;
use App\Models\Order;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.invoice.index', [
            'active' => 'Invoice',
            'transactions' => Transaction::get(),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function print(Transaction $transaction)
    {
        return view('dashboard.invoice.print', [
            'active' => 'Invoice',
            'transaction' => $transaction,
            'peserta' => Participant::where('nama', $transaction->nama_peserta)->first(),
            'orders' => Order::where('kode_inv', $transaction->kode_inv)->get(),
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        Order::where('kode_inv', $transaction->kode_inv)->delete();
        Transaction::destroy($transaction->id);
        return redirect('/dashboard/invoice')->with('success', 'Invoice telah dihapus!');
    }
}
