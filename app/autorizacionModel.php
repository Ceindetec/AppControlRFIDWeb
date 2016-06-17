<?php

namespace accesorfid;

use Illuminate\Database\Eloquent\Model;

class autorizacionModel extends Model
{
    protected $table = 'autorizacion';
	protected $primaryKey = 'aut_id';
	public $timestamps = false;

	public function getfuncionario()
	{
		return $this->belongsTo('accesorfid\fucionarioModel', 'aut_funcionario_id', 'func_id');
	}
}
