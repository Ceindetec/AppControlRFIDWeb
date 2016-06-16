<div id="Editarfuncionario">
	{!!Form::model($data)!!}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4> Editar modulo RFID</h4>
	</div>
	<div class="modal-body">
		{!!Form::hidden('func_id')!!}
		<div class="form-group">
			{!!Form::label('Tipo de documento (*)')!!}
			{!!Form::text('func_tdocumento_id',null,['class'=>'form-control', 'required', 'id'=>'tdocumento', 'style'=>'width:100%'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('numero de documento (*)')!!}
			{!!Form::text('func_documento',null,['class'=>'form-control', 'required', 'maxlength'=>'11'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Nombres (*)')!!}
			{!!Form::text('func_nombres',null,['class'=>'form-control', 'required', 'maxlength'=>'100'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Apellidos (*)')!!}
			{!!Form::text('func_apellidos',null,['class'=>'form-control', 'required', 'maxlength'=>'100'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Cod. tarjeta RFID (*)')!!}
			{!!Form::text('func_tarjeta',null,['class'=>'form-control', 'required', 'maxlength'=>'45'])!!}
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		<input type="submit" class="btn btn-success" value="Guardar">
	</div>
</div>
{!!Form::close()!!}



<script type="text/javascript">

//modalBs.modal('hide');

var modal = $('#Editarfuncionario');

$(function(){
    validarFormulario();// validar forularios con kendo
    EventoFormularioModal(modal, onSuccess, oneError)

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

});

function validarFormulario(){
	/*metodo de kendo para validar los formulario*/
	$('form').kendoValidator();
}


function onSuccess(result) {
	result = JSON.parse(result)
	if(result.estado==true){
		$.msgbox(result.mensaje, { type: 'success' }, function(){
			table[0].ajax.reload();
			modalBs.modal('hide');
		});
	}else{
		$.msgbox(result.mensaje, { type: 'error' }, function(){
			modalBs.modal('hide');
		});
	}
}

function oneError(result){
	html = "<ul>";
	if(result.func_documento){
		for (var i = 0; i < result.func_documento.length; i++) {
			html +="<li>"+result.func_documento[i]+"</li>";
		};
	}
	if(result.func_nombres){
		for (var i = 0; i < result.func_nombres.length; i++) {
			html +="<li>"+result.func_nombres[i]+"</li>";
		};
	}
	if(result.func_apellidos){
		for (var i = 0; i < result.func_apellidos.length; i++) {
			html +="<li>"+result.func_apellidos[i]+"</li>";
		};
	}
	if(result.func_tarjeta){
		for (var i = 0; i < result.func_tarjeta.length; i++) {
			html +="<li>"+result.func_tarjeta[i]+"</li>";
		};
	}
	html +="</ul>";
	$.msgbox(html, { type: 'error' });
}
</script>