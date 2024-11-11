<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Inventory;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.package.index', [
            'active' => 'Paket',
            'packages' => Package::with('inventories')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.package.create', [
            'active' => 'Paket',
            'inventories' => Inventory::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request)
    {
        // Create the new package with validated data
        $package = Package::create(['nama_paket' => $request->validated('nama_paket')]);

        // Attach selected items with their quantities to the package
        foreach ($request->validated('inventories') as $inventoryId => $data) {
            $quantity = $data['quantity'] ?? 0; // Default to 0 if quantity is not set

            // Only add the item if the quantity is greater than 0
            if ($quantity > 0) {
                $package->inventories()->attach($inventoryId, ['quantity' => $quantity]);
            }
        }

        // Redirect to the package index page with a success message
        return redirect()->route('package.index')->with('success', 'Paket berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        return view('dashboard.package.edit', [
            'active' => 'Paket',
            'package' => $package,
            'inventories' => Inventory::all(),
            'packageItems' => $package->inventories->pluck('pivot.quantity', 'id')->toArray(), // Quantities for this package
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        // Update package name
        $package->update(['nama_paket' => $request->validated('nama_paket')]);

        // Update package items with quantities
        $package->inventories()->detach();
        foreach ($request->validated('inventories') as $inventoryId => $data) {
            $quantity = $data['quantity'] ?? 0;

            if ($quantity > 0) {
                $package->inventories()->attach($inventoryId, ['quantity' => $quantity]);
            }
        }

        return redirect()->route('package.index')->with('success', 'Paket berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        // Detach all related inventories to remove relationships
        $package->inventories()->detach();

        // Delete the package itself
        $package->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('package.index')->with('success', 'Paket berhasil dihapus!');
    }
}
