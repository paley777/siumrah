<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.participant.index', [
            'active' => 'Manajemen',
            'participants' => Participant::orderBy('nama', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.participant.create', [
            'active' => 'Manajemen',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParticipantRequest $request)
    {
        $validated = $request->validated();
        Participant::create($validated);

        return redirect('/dashboard/participant')->with('success', 'Peserta Umrah telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participant $participant)
    {
        return view('dashboard.participant.edit', [
            'active' => 'Manajemen',
            'participant' => $participant,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParticipantRequest $request, Participant $participant)
    {
        $validated = $request->validated();
        Participant::where('id', $participant['id'])->update($validated);

        return redirect('/dashboard/participant')->with('success', 'Peserta Umrah telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        Participant::destroy($participant->id);
        return redirect('/dashboard/participant')->with('success', 'Peserta Umrah telah dihapus!');
    }
}
