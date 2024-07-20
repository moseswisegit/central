<?php
namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreParoissesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom_paroisse' => ['required', 'string', 'max:255'],
            'pays_id' => ['required', 'exists:pays,id'],
            'ville_id' => ['required', 'exists:villes,id'],
            'commune_id' => ['required', 'exists:communes,id'],
            'quartier_id' => ['required', 'exists:quartiers,id'],
            'adresse_paroisse' => ['required', 'string', 'max:255'],
            'nom_charge' => ['required', 'string', 'max:255'],
            'numero_charge' => ['required', 'string', 'max:255'],
            'nom_secretaire' => ['required', 'string', 'max:255'],
            'numero_secretaire' => ['required', 'string', 'max:255'],
            'nom_maitre_choeur' => ['required', 'string', 'max:255'],
            'numero_maitre_choeur' => ['required', 'string', 'max:255'],
            'image_eglise' => ['required', 'image', 'mimes:jpeg,png,gif', 'max:2048'],
        ];
    }
}
