@extends('layouts.admin.principal')



@section('content')


<div class="page-title">
	<div class="title_left">
		<h3>
			Registro de invitados
		</h3>
	</div>
</div>
<div class="clearfix"></div>


<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"></h3>
	</div>
	<div class="panel-body">
		
		{!!Form::open()!!}

		<div class="form-group">
			{!!Form::label('Tipo de documento (*)')!!}
			{!!Form::text('func_tdocumento_id',null,['class'=>'form-control', 'required', 'id'=>'tdocumento', 'style'=>'width:100%'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('numero de documento (*)')!!}
			
			<div class="input-group">
				<input type="text" name="func_documento" id="func_documento" onkeypress="return SoloNumeros(event)" class="form-control">
				<span class="input-group-btn">
					<button type="button" class="btn btn-primary" id="buscador"><i class="fa fa-search" aria-hidden="true"></i></button>
				</span>
			</div>
		</div>
		<div class="form-group">
			{!!Form::label('Nombres (*)')!!}
			{!!Form::text('func_nombres',null,['class'=>'form-control', 'required', 'maxlength'=>'100', 'onkeypress'=>"return soloLetras(event)"])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Apellidos (*)')!!}
			{!!Form::text('func_apellidos',null,['class'=>'form-control', 'required', 'maxlength'=>'100', 'onkeypress'=>"return soloLetras(event)"])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Oficina (*)')!!}
			{!!Form::text('mod_id',null,['class'=>'form-control', 'required', 'id'=>'Oficina', 'style'=>'width:100%'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Cod. tarjeta RFID (*)')!!}
			{!!Form::text('func_tarjeta',null,['class'=>'form-control', 'required', 'maxlength'=>'8','onkeypress'=>"return solocodigos(event)"])!!}
		</div>
		<div class='text-right'>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<input type="submit" class="btn btn-success" value="Guardar">
		</div>
		{!!Form::close()!!}


	</div>
</div>







@endsection

@section('scripts')

<script type="text/javascript">



$(function(){

	$("#tdocumento").kendoDropDownList({
		dataTextField: "tdoc_nombre",
		dataValueField: "tdoc_id",
		width:"100%",
		dataSource: {
			transport: {
				read: {
					dataType: "json",
					type:"POST",
					url: "{!!route('drodtdocumento')!!}",
				}
			}
		},
		optionLabel: {
			tdoc_nombre: "Seleccione...",
			tdoc_id: ""
		}
	});

	$("#func_documento").kendoAutoComplete({
		dataTextField: "func_documento",
		filter: "contains",
		minLength: 3,
		dataSource: {
			type: "json",
			serverFiltering: true,
			transport: {
				read: "{!!route('getdocumento')!!}"
			}
		}
	});

	$.post("{!!route('drodmdulo')!!}", function(result){

		var data = $.map(result, function (obj) {
			obj.text = obj.mod_nombre || obj.name; 
			obj.id = obj.mod_id;
			return obj;
		});

		$("#Oficina").select2({
			data:data
		});

	});

	$("#buscador").click(function(){
		buscar();
	});


	$("form").submit(function(event){
		$.ajax({
			url: this.action,
			type: this.method,
			data: $(this).serialize(),
			success: function (result) {
				onSuccess(result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				if(jqXHR.status == 422){
					oneError(JSON.parse(jqXHR.responseText));
				}else{
					var message = "Error de ejecución: " + textStatus + " " + errorThrown;
					$.msgbox(message, { type: 'error' });
					console.log("Error: "); 
				}

			}
		});
		return false;
	})


});

function oneError(result){
	console.log(result);
}

function onSuccess(result){
	if(result.estado){
		$.msgbox(result.mensaje, { type: 'success' });
	}else{
		$.msgbox(result.mensaje, { type: 'error' });	
	}
}


function buscar(){
	var datos = {'tdocumento' : $("#tdocumento").val(), "documento" : $("#func_documento").val()};
	
	$.post("{!!route('buscarinvitado')!!}",datos,function(result){
		if(result.estado){
			$("input[name=func_nombres]").val(result.result.func_nombres);
			$("input[name=func_apellidos]").val(result.result.func_apellidos);
		}
	});
}





</script>

@endsection