<?php

namespace accesorfid;

use Illuminate\Database\Eloquent\Model;

class accesoModel extends Model
{
    protected $table = 'acceso';
    protected $primaryKey = 'acc_id';
    public $timestamps = false;

    public function funcionario()
    {
        return $this->belongsTo('accesorfid\fucionarioModel', 'acc_funcionario_id', 'func_id');
    }

    public function modulo()
    {
        return $this->belongsTo('accesorfid\moduloModel', 'acc_modulo_id', 'mod_id');
    }


}
