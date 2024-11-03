<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Participant;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UpdateProfileRequest;

class DashboardController extends Controller
{
    //Index
    public function index()
    {
        return view('dashboard.index', [
            'active' => 'Beranda',
            'total_peserta' => Participant::count(),
            'total_barang' => Inventory::count(),
            'total_transaksi' => Transaction::count(),
        ]);
    }
    /**
     * Handle an logout attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function my_profile()
    {
        return view('dashboard.profile.index', [
            'active' => 'Profil Saya',
        ]);
    }

    public function my_profile_edit()
    {
        return view('dashboard.profile.edit', [
            'active' => 'Profil Saya',
        ]);
    }

    public function my_profile_store(UpdateProfileRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        User::where('id', auth()->user()->id)->update($validated);

        return redirect('/dashboard/my-profile')->with('success', 'Profil telah diubah!');
    }
}
