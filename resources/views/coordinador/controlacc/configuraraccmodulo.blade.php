@extends('layouts.admin.principal')

@section('css')
<style>
div[role="main"] div[role="progressbar"]{
	width: 100%;
	margin:0;
	display:none;
	text-align: left;
	padding: 5px;
	border-radius: 5px;
}

#btnactualizar, #btnconectar{
	float:right;
}
</style>
@endsection
@section('content')

<div class="row">
	<div id="Conectado" class="progress-bar bg-green row" role="progressbar">
		<span>Conección con el servidor establesidad <button id="btnactualizar" class="btn btn-primary" onclick="actualizar()">Actualizar modulo</button></span>
	</div>

	<div id="desconectado" class="progress-bar bg-orange row" role="progressbar" >
		Se a perdido la conección con el servidor <button id="btnconectar" class="btn btn-success">Conectar</button>
	</div>
</div>

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

var ws;
var datajsonws = {};

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

	WebSocketTest();

	$("#btnconectar").click(function(){
		WebSocketTest();
	});

});

function eliminar(event){
	var element = event.target;
	var data = table[1].row( $(element).parents('tr')).data();
	data = {'mod_id':'{{$query->mod_id}}','func_id':data.func_id};
	$.post("{!!route('eliminarfuncionariomoduloRFID')!!}", data, function(result){
		console.log(result);
		datajsonws.dispositivo = "PC";
		datajsonws.accion="DEL";
		result = JSON.stringify(result);
		datajsonws.data = result;
		enviar = JSON.stringify(datajsonws);
		ws.send(enviar);
		table[0].ajax.reload();
		table[1].ajax.reload();
	});
}

function agregar(event){
	var element = event.target;
	var data = table[0].row( $(element).parents('tr')).data();
	data = {'mod_id':'{{$query->mod_id}}','func_id':data.func_id};
	$.post("{!!route('agregarfuncionariomoduloRFID')!!}", data, function(result){
		datajsonws.dispositivo = "PC";
		datajsonws.accion="INS";
		result = JSON.stringify(result);
		datajsonws.data = result;
		enviar = JSON.stringify(datajsonws);
		ws.send(enviar);
		table[0].ajax.reload();
		table[1].ajax.reload();
	});
}

function actualizar(){
	$.post("{!!route('actualizartodomoduloRFID')!!}",{"modulo":"{!! $query->mod_id !!}"},function(result){
		datajsonws.dispositivo = "PC";
		datajsonws.accion="UPD";
		var array = [];
		var predata = {};
		predata.modulo = result[0].getmodulo.mod_codigo;
		for(i=0;i<result.length;i++) {
			array.push(result[i].getfuncionario.func_tarjeta)
		}
		predata.data = array;
		predata = JSON.stringify(predata);
		datajsonws.data = predata;
		enviar = JSON.stringify(datajsonws);
		ws.send(enviar);
	})
}

function WebSocketTest()
{

	ws = new WebSocket("ws://192.168.0.245:8081/streaming");

	ws.onopen = function()
	{
			// Web Socket is connected, send data using send()
			//ws.send("Message to send");
			$('#desconectado').hide();
			$('#Conectado').show();

			datajsonws.dispositivo = "PC";
				datajsonws.accion="permiso";
				datajsonws.data="";
				enviar = JSON.stringify(datajsonws);
				ws.send(enviar);

		};

		ws.onmessage = function (evt)
		{
			var received_msg = evt.data;

		};

		ws.onclose = function()
		{
			// websocket is closed.
			$('#desconectado').show();
			$('#Conectado').hide();
			//alert("Connection is closed...");
		};

		ws.error = function()
		{
		// websocket is closed.
		$('#desconectado').show();
		$('#Conectado').hide();
		//alert("error.");
	};

}


</script>

@endsection