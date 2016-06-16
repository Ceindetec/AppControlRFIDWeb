<?php

namespace accesorfid;

use Illuminate\Database\Eloquent\Model;

class tipodocumentoModel extends Model
{
	protected $table = 'tipo_documento';
	protected $primaryKey = 'tdoc_id';
	public $timestamps = false;
}
