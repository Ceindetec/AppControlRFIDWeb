<?php

namespace accesorfid;

use Illuminate\Database\Eloquent\Model;

class fucionarioModel extends Model
{
    protected $table = 'funcionario';
	protected $primaryKey = 'func_id';
	public $timestamps = false;

	public function tdocumento()
	{
		return $this->belongsTo('accesorfid\tipodocumentoModel', 'func_tdocumento_id', 'tdoc_id');
	}
}
