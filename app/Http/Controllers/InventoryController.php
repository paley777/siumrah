<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.inventory.index', [
            'active' => 'Manajemen',
            'inventories' => Inventory::orderBy('nama_barang', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.inventory.create', [
            'active' => 'Manajemen',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request)
    {
        $validated = $request->validated();
        Inventory::create($validated);

        return redirect('/dashboard/inventory')->with('success', 'Perlengkapan Umrah telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        return view('dashboard.inventory.edit', [
            'active' => 'Manajemen',
            'inventory' => $inventory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $validated = $request->validated();
        Inventory::where('id', $inventory['id'])->update($validated);

        return redirect('/dashboard/inventory')->with('success', 'Perlengkapan Umrah telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        Inventory::destroy($inventory->id);
        return redirect('/dashboard/inventory')->with('success', 'Perlengkapan Umrah telah dihapus!');
    }
}
