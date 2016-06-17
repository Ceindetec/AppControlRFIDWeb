@extends('layouts.admin.principal')



@section('content')


<div class="page-title">
	<div class="title_left">
		<h3>
			Registro de funcionarios 
		</h3>
	</div>
</div>
<div class="clearfix"></div>




<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"></h3>
		<a href="{!!route('registrarfuncionario')!!}" class="btn btn-success" data-modal="">Registrar nuevo funcionario</a>
	</div>
	<div class="panel-body">
		<table id="FuncionariosRFID" class="table table-striped table-bordered no-footer" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Id funcionario</th>
					<th>tipo de documento</th>
					<th>Numero de documento</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Cod. tarjeta RFID</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>



@endsection

@section('scripts')

<script type="text/javascript">

$(function(){

	/*$('#MudulosRFID').on('init.dt', function ( ) {
		handleAjaxModal();
	})*/


table[0] = $('#FuncionariosRFID').DataTable( {
	"language": {
		"url": "{!!route('espanol')!!}"
	},
	ajax: {
		url: "{!!route('gridfuncionariosRFID')!!}",
		"type": "POST"
	},
	columns: [ {data:'func_id'},{data:'tdocumento.tdoc_sigla'}, {data: 'func_documento'}, {data: 'func_nombres'}, {data: 'func_apellidos'},{data: 'func_tarjeta'}],
	"columnDefs": [
	{
		"targets": [0],
		"visible": false,
		"searchable": false
	},
	{
		"targets": [6],
		"data": null,
		"defaultContent": "<a href={!!route('modaleditarfuncionario')!!} data-modal=''  data-id='func_id' table='0'; class='btn btn-primary'>Editar</a>" 
	},
	{
		"targets": [7],
		"data": null,
		"defaultContent":  "<button class='btn btn-danger' onclick='eliminar(event)'>Eliminar</button>" 
	}
	],
	"scrollX": true
} );

});

function eliminar(event){
	var element = event.target;
	$.msgbox("Esta seguro que desea elimnar este modulo", { type: 'confirm' }, function(result){
		if(result == 'Aceptar'){
			var data = table[0].row( $(element).parents('tr')).data()
			$.post("{!!route('eliminarfuncionario')!!}", {'func_id':data.func_id}, function(result){
				result = JSON.parse(result)
				if(result.estado){
					$.msgbox(result.mensaje, { type: 'success' }, function(){
						table[0].ajax.reload();
					});
				}
			});
		}
	});
	
}

</script>

@endsection