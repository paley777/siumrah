<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Package;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use Illuminate\Support\Facades\Storage;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.participant.index', [
            'active' => 'Manajemen',
            'packages' => Package::all(),
            'participants' => Participant::with('package')->orderBy('nama', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.participant.create', [
            'active' => 'Manajemen',
            'packages' => Package::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParticipantRequest $request)
    {
        // Validate the request
        $validated = $request->validated();

        // Check if there's an uploaded file
        if ($request->hasFile('foto_ktp')) {
            $file = $request->file('foto_ktp');

            // Define a unique filename with extension
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Store the file in the 'foto_ktp' disk with the defined filename
            $filePath = $file->storeAs('', $filename, 'foto_ktp');

            // Store the file path in the validated data array for the database
            $validated['foto_ktp'] = $filePath;
        }

        // Create the participant record in the database with the validated data
        Participant::create($validated);

        // Redirect back with a success message
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
            'packages' => Package::all(), // Pass all available packages to the view
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParticipantRequest $request, Participant $participant)
    {
        $validated = $request->validated();

        // Check if there's an uploaded file
        if ($request->hasFile('foto_ktp')) {
            $file = $request->file('foto_ktp');

            // If there is an existing file, delete it before storing the new one
            if ($participant->foto_ktp) {
                Storage::disk('foto_ktp')->delete($participant->foto_ktp);
            }

            // Define a unique filename with extension
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Store the file in the 'foto_ktp' disk with the defined filename
            $filePath = $file->storeAs('', $filename, 'foto_ktp');

            // Update the file path in the validated data array for the database
            $validated['foto_ktp'] = $filePath;
        } else {
            // Retain the original foto_ktp if no new file is uploaded
            $validated['foto_ktp'] = $participant->foto_ktp;
        }

        // Update the participant with the validated data
        Participant::where('id', $participant['id'])->update($validated);

        return redirect('/dashboard/participant')->with('success', 'Peserta Umrah telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        // Check if the participant has an existing foto_ktp file and delete it
        if ($participant->foto_ktp) {
            Storage::disk('foto_ktp')->delete($participant->foto_ktp);
        }

        // Delete the participant record from the database
        Participant::destroy($participant->id);

        return redirect('/dashboard/participant')->with('success', 'Peserta Umrah telah dihapus!');
    }
}
