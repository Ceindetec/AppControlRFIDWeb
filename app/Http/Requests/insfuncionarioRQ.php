<?php

namespace accesorfid\Http\Requests;

use accesorfid\Http\Requests\Request;

class insfuncionarioRQ extends Request
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
            'func_tdocumento_id'=>'required',
            'func_documento'=>'required|unique:funcionario,func_documento|max:11',
            'func_nombres'=>'required|max:100',
            'func_apellidos'=>'required|max:100',
            'func_tarjeta'=>'required|unique:funcionario,func_tarjeta|max:8',
        ];
    }

    public function messages(){
        return[
           'func_documento.max'=>"El documento debe contener maximo 11 caractares.",
           'func_documento.unique'=>"Ya esta registrado un funcionario con este documento.",
           'func_nombres.max'=>'Los nombres no debe contener mas de 100 caracteres.',
           'func_apellidos.max'=>'Los apellidos no debe contener mas de 100 caracteres.',
           'func_tarjeta.max'=>'El cod. de la tarjeta no debe contener mas de 8 caracteres.',
           'func_tarjeta.unique'=>'Ya esta registado este codigo de tarjeta'
        ];
    }
}
