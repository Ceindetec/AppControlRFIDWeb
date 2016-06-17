@extends('layouts.admin.principal')



@section('content')


<div class="page-title">
	<div class="title_left">
		<h3>
			Control de acceso por modulos
		</h3>
	</div>
</div>
<div class="clearfix"></div>


<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"></h3>
	</div>
	<div class="panel-body">
		<table id="Controlmodulos" class="table table-striped table-bordered no-footer" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>id</th>
					<th>Nombre oficina</th>
					<th>Detalle</th>
					<th>Configurar</th>
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



	table[0] = $('#Controlmodulos').DataTable( {
		"language": {
			"url": "{!!route('espanol')!!}"
		},
		ajax: {
			url: "{!!route('gridcontrolaccRFID')!!}",
			"type": "POST"
		},
		columns: [ {data:'mod_id'},{data:'mod_nombre'}],
		"columnDefs": [
		{
			"targets": [0],
			"visible": false,
			"searchable": false
		},
		{
			"targets": [2],
			"data": null,
			"width": "25%",
			"defaultContent": "<a href={!!route('modaldetalleaccmod')!!} data-modal='modal-lg'  data-id='mod_id' table='0'; class='btn btn-success'>Ver detalle</a>" 
		},
		{
			"targets": [3],
			"data": null,
			"width": "25%",
			"defaultContent":  "<button class='btn btn-primary' onclick='redirecionar(event)'>Configurar</button>" 
		}
		],
		"scrollX": true
	} );

});

function redirecionar(event){
	var element = event.target;
	var data = table[0].row( $(element).parents('tr')).data();
	window.location.href= '/configurarmodulo/'+data.mod_id+'/configurar';
}

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