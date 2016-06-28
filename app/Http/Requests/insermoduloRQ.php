<?php

namespace accesorfid\Http\Requests;

use accesorfid\Http\Requests\Request;

class insermoduloRQ extends Request
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
            'mod_codigo'=>'required|unique:modulo,mod_id|max:8',
            'mod_nombre'=>'required|max:45',
            //
        ];
    }

    public function messages(){
        return[
           'mod_codigo.unique'=>"Esta id de modulo ya ha sido registrado.." ,
           'mod_codigo.max'=>"la id del modulo No debe contener mas de 8 caracteres.",
           'mod_nombre.max'=>'El nombre del modulo No debe contener mas de 45 caracteres.'
        ];
    }
}
