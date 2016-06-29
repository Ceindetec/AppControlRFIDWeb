<div id="NombreDelModal">
	
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4>Registro de modulo RFID</h4>
	</div>
	<div class="modal-body">

		<div class="" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
				<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Registro individual</a>
				</li>
				<!-- <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Carga masiva</a>
				</li> -->
			</ul>
			<div id="myTabContent" class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
					{!!Form::open()!!}
					
					<div class="form-group">
						{!!Form::label('codigo modulo RFID (*)')!!}
						{!!Form::text('mod_codigo',null,['class'=>'form-control', 'required', 'maxlength'=>'8'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('Nombre oficina (*)')!!}
						{!!Form::text('mod_nombre',null,['class'=>'form-control', 'required', 'maxlength'=>'45'])!!}
					</div>
					<div class='text-right'>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<input type="submit" class="btn btn-success" value="Guardar">
					</div>
					{!!Form::close()!!}
				</div>
				<!-- <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
					<p>
						Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
						booth letterpress, commodo enim craft beer mlkshk aliquip
					</p>
				</div> -->

			</div>
		</div>


	</div>
	<div class="modal-footer">
	</div>
</div>




<script type="text/javascript">

//modalBs.modal('hide');

var modal = $('#NombreDelModal');

$(function(){
    validarFormulario();// validar forularios con kendo
    EventoFormularioModal(modal, onSuccess, oneError)
});

function validarFormulario(){
	/*metodo de kendo para validar los formulario*/
	$('form').kendoValidator();
}


function onSuccess(result) {
	result = JSON.parse(result)
	if(result.estado=true){
		$.msgbox(result.mensaje, { type: 'success' }, function(){
			table[0].ajax.reload();
			modalBs.modal('hide');
		});
	}
}


function oneError(result){
	html = "<ul>";
	if(result.mod_id){
		for (var i = 0; i < result.mod_id.length; i++) {
			html +="<li>"+result.mod_id[i]+"</li>";
		};
	}
	if(result.mod_nombre){
		for (var i = 0; i < result.mod_nombre.length; i++) {
			html +="<li>"+result.mod_nombre[i]+"</li>";
		};
	}
	html +="</ul>";
	$.msgbox(html, { type: 'error' });
}


</script>