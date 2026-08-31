<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportCSVRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Seul un admin peut importer des fichiers CSV
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:csv,txt|max:10240', // Max 10MB
            'type' => 'required|in:formateurs,seances,affectations',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Un fichier CSV est requis.',
            'file.mimes' => 'Le fichier doit être au format CSV ou TXT.',
            'file.max' => 'Le fichier ne doit pas dépasser 10 MB.',
            'type.required' => 'Le type de données est requis.',
            'type.in' => 'Le type doit être formateurs ou seances.',
        ];
    }
}
