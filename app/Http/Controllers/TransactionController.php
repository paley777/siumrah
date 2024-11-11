<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Participant;
use App\Models\Inventory;
use App\Models\Package;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class TransactionController extends Controller
{
    // fungsi generateCustomID di dalam controller
    private function generateCustomID($prefix, $table, $field)
    {
        return DB::transaction(function () use ($prefix, $table, $field) {
            $latestId = DB::table($table)->latest('id')->first();
            $nextId = $latestId ? $latestId->id + 1 : 1;
            return $prefix . str_pad($nextId, 8, '0', STR_PAD_LEFT);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.transaction.index', [
            'active' => 'Transaksi',
            'participants' => Participant::get(),
            'inventories' => Inventory::get(),
            'packages' => Package::with('inventories')->get(),
            'kode_inv' => $this->generateCustomID('UMRH-', 'transactions', 'kode_inv'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->validated();

        // Pisahkan ID dan nama peserta dari participant_id
        [$participant_id, $participant_name] = explode('|', $validated['participant_id']);

        // Iterasi data barang yang dipesan
        $nama_barang = $request->input('nama_barang');
        $qty = $request->input('qty');

        foreach ($nama_barang as $key => $nama_barang) {
            Order::create([
                'kode_inv' => $validated['kode_inv'],
                'nama_barang' => $nama_barang,
                'qty' => $qty[$key],
            ]);

            $kurang = $qty[$key];
            $inventory = Inventory::where('nama_barang', $nama_barang)->first();
            if ($inventory) {
                $inventory->kurangStok($kurang);
            }
        }

        // Menyimpan transaksi dengan participant_id dan nama_peserta
        Transaction::create([
            'kode_inv' => $validated['kode_inv'],
            'nama_petugas' => $validated['nama_petugas'],
            'nama_peserta' => $participant_name, // Simpan nama peserta yang dipisahkan
            'status' => $validated['status'],
            'keterangan' => $validated['keterangan'],
            'participant_id' => $participant_id, // Simpan ID peserta yang dipisahkan
        ]);

        return redirect()->back()->with('success', 'Transaksi sukses, Silakan menuju fitur Invoice untuk mencetak!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
