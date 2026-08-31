<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormateurRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Admin et Direction peuvent modifier un formateur
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'D']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $formateurId = $this->route('formateur')?->Matricule;
        
        return [
            'Matricule' => 'required|string|unique:formateurs,Matricule,' . $formateurId . ',Matricule',
            'Nom' => 'required|string|max:255',
            'Prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:formateurs,email,' . $formateurId . ',Matricule',
        ];
    }
}
