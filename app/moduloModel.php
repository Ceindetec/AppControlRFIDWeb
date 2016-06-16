<?php

namespace accesorfid;

use Illuminate\Database\Eloquent\Model;

class moduloModel extends Model
{
	protected $table = 'modulo';
	protected $primaryKey = 'mod_id';
	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('accesorfid\User', 'mod_usuario_id', 'usu_id');
	}
}
