@extends('layouts.admin.principal')



@section('content')


<div class="page-title">
	<div class="title_left">
		<h3>
			Control de invitados
		</h3>
	</div>
</div>
<div class="clearfix"></div>




<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"></h3>
	</div>
	<div class="panel-body">
		<table id="MudulosRFID" class="table table-striped table-bordered no-footer" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>tipo de documento</th>
					<th>Numero de documento</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Oficina</th>
					<th>Salida</th>
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


table[0] = $('#MudulosRFID').DataTable( {
	"language": {
		"url": "{!!route('espanol')!!}"
	},
	ajax: {
		url: "{!!route('gridinvitadosRFID')!!}",
		"type": "POST"
	},
	columns: [{data:'tdocumento.tdoc_sigla'}, {data: 'func_documento'}, {data: 'func_nombres'}, {data: 'func_apellidos'},{data: 'mod_nombre'}],
	"columnDefs": [

	{
		"targets": [5],
		"data": null,
		"defaultContent": "<a href=# class='btn btn-danger' onclick='salida(event)'>Salida</a>" 
	}
	],
	"scrollX": true
} );

});

function salida(event){
	var element = event.target;
	$.msgbox("Esta seguro que desea dar salidad al invitado", { type: 'confirm' }, function(result){
		if(result == 'Aceptar'){
			var data = table[0].row( $(element).parents('tr')).data()
			$.post("{!!route('salidainvitado')!!}", {'aut_id':data.aut_id, 'func_id':data.func_id}, function(result){
				//result = JSON.parse(result)
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