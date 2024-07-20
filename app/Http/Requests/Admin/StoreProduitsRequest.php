<?php
namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProduitsRequest extends FormRequest
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
            'designation' => 'required|string|max:255',
            'qte_command' => '',
            'qte_recu' => '',
            'prix_unitaire' => '',
            'date_livraison' => 'required',
            'etat_livraison' => 'required|string',
            'categorie_id' => 'required',
            'fournisseur_id' => 'required',
        ];
    }
}
