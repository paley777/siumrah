<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreParticipantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nik' => 'required|unique:participants',
            'nama' => 'required',
            'no_tlp' => 'required',
            'alamat' => 'required',
            'foto_ktp' => 'required|file|mimes:jpg,jpeg,png',
            'package_id' => 'nullable|exists:packages,id', // Ensure the package ID is valid if provided
        ];
    }
}
