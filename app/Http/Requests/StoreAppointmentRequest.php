<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:now'
        ];
    }

    public function messages()
    {
        return [
            'appointment_date.after' => 'La date du rendez-vous doit être dans le futur.',
            'doctor_id.exists' => 'Le médecin sélectionné n existe pas.',
        ];
    }
}
