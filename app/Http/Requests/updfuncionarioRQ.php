<?php

namespace accesorfid\Http\Requests;

use accesorfid\Http\Requests\Request;

class updfuncionarioRQ extends Request
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
            'func_documento'=>'required|max:11',
            'func_nombres'=>'required|max:100',
            'func_apellidos'=>'required|max:100',
            'func_tarjeta'=>'required|max:8',
        ];
    }

    public function messages(){
        return[
           'func_documento.max'=>"El documento debe contener maximo 11 caractares.",
           'func_nombres.max'=>'Los nombres no debe contener mas de 100 caracteres.',
           'func_apellidos.max'=>'Los apellidos no debe contener mas de 45 caracteres.',
           'func_tarjeta.max'=>'El cod. de la tarjeta no debe contener mas de 8 caracteres.'
        ];
    }
}
