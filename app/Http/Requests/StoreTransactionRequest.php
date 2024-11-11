<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTransactionRequest extends FormRequest
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
            'kode_inv' => 'required',
            'nama_petugas' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
            'nama_barang.*' => 'required',
            'participant_id' => 'required',
            'qty.*' => 'required',
        ];
    }
}
