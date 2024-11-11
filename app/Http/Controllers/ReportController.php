<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Participant;
use App\Models\Inventory;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function participant()
    {
        return view('dashboard.report.participant', [
            'active' => 'laporan',
            'participants' => Participant::get(),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function inventory()
    {
        return view('dashboard.report.inventory', [
            'active' => 'laporan',
            'inventories' => Inventory::get(),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function transaction()
    {
        return view('dashboard.report.transaction', [
            'active' => 'laporan',
            'transactions' => Transaction::with('participant.package')->get(),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function order()
    {
        return view('dashboard.report.order', [
            'active' => 'laporan',
            'orders' => Order::get(),
        ]);
    }
}
