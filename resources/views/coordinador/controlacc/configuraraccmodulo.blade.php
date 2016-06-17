@extends('layouts.admin.principal')
@section('content')

<div class="page-title">
	<div class="title_left">
		<h3>
			Configuración {!!$query->mod_nombre!!}
		</h3>
	</div>
</div>
<div class="clearfix"></div>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">


	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Usuarios sin autorizados</h3>
		</div>
		<div class="panel-body">
			<table id="noAutorizados" class="table table-striped table-bordered no-footer" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>id</th>
						<th>Tipo de documento</th>
						<th>Documento</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Autorizar</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>

</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Usuarios autorizados</h3>
		</div>
		<div class="panel-body">
			<table id="Autorizados" class="table table-striped table-bordered no-footer" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>id</th>
						<th>Tipo de documento</th>
						<th>Documento</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Autorizar</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
	
</div>


@endsection

@section('scripts')

<script type="text/javascript">

$(function(){

	table[0] = $('#noAutorizados').DataTable( {
		"language": {
			"url": "{!!route('espanol')!!}"
		},
		ajax: {
			url: "{!!route('gridnoautorizadosRFID', ['mod_id'=>$query->mod_id])!!}",
			"type": "POST"
		},
		columns: [ {data:'func_id'},{data:'tdocumento.tdoc_sigla'}, {data:'func_documento'}, {data:'func_nombres'}, {data:'func_apellidos'}],
		"columnDefs": [
		{
			"targets": [0],
			"visible": false,
			"searchable": false
		},
		{
			"targets": [5],
			"data": null,
			"defaultContent": "<a href='#' class='btn btn-success' onclick='agregar(event)'><i class='fa fa-user-plus' aria-hidden='true'></i></a>" 
		},
		],
		"scrollY":        "200px",
		"scrollCollapse": true,
		"paging":         false,
		"scrollX": true,
	} );

	table[1] = $('#Autorizados').DataTable( {
		"language": {
			"url": "{!!route('espanol')!!}"
		},
		ajax: {
			url: "{!!route('gridautorizadosRFID', ['mod_id'=>$query->mod_id])!!}",
			"type": "POST"
		},
		columns: [ {data:'func_id'},{data:'tdocumento.tdoc_sigla'}, {data:'func_documento'}, {data:'func_nombres'}, {data:'func_apellidos'}],
		"columnDefs": [
		{
			"targets": [0],
			"visible": false,
			"searchable": false
		},
		{
			"targets": [5],
			"data": null,
			"defaultContent": "<a href='#' onclick='eliminar(event)' class='btn btn-danger'><i class='fa fa-user-times' aria-hidden='true'></i></a>" 
		},
		],
		"scrollY":        "200px",
		"scrollCollapse": true,
		"paging":         false,
		"scrollX": true,
	} );

});

function eliminar(event){
	var element = event.target;
	var data = table[1].row( $(element).parents('tr')).data();
	data = {'mod_id':'{{$query->mod_id}}','func_id':data.func_id};
	$.post("{!!route('eliminarfuncionariomoduloRFID')!!}", data, function(result){
		table[0].ajax.reload();
		table[1].ajax.reload();
	});
}

function agregar(event){
	var element = event.target;
	var data = table[0].row( $(element).parents('tr')).data();
	data = {'mod_id':'{{$query->mod_id}}','func_id':data.func_id};
	$.post("{!!route('agregarfuncionariomoduloRFID')!!}", data, function(result){
		table[0].ajax.reload();
		table[1].ajax.reload();
	});
}


	

</script>

@endsection