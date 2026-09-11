<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Seul un formateur peut modifier une séance
        return auth()->check() && auth()->user()->role === 'F';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $seanceId = $this->route('seance')?->NumS;
        
        return [
            'NumS' => 'required|string|unique:seances,NumS,' . $seanceId . ',NumS',
            'Matricule' => 'required|exists:formateurs,Matricule',
            'CodeG' => 'required|exists:groupes,CodeG',
            'CodeM' => 'required|exists:modules,CodeM',
            'TypeCours' => 'required|in:P,D',
            'Jour' => 'required|string',
            'HeureD' => 'required|date_format:H:i',
            'HeureF' => 'required|date_format:H:i|after:HeureD',
            'Duree' => 'nullable|integer|min:1',
            'EffAbsent' => 'nullable|integer|min:0',
        ];
    }
}
