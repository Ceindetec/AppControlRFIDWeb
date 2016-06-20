<div id="DetalleAccMod">
	
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4>Funcionarios autorizados en {!!$query->mod_nombre!!}</h4>
	</div>
	<div class="modal-body">
		<a href="/configurarmodulo/{{$query->mod_id}}/configurar"  class='btn btn-primary'>Configurar</a>

		<div class="panel panel-default">
			<div class="panel-body">
				<table id="gridDetalleaccmod" class="table table-striped table-bordered no-footer" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>id</th>
							<th>Tipo de documento</th>
							<th>Documento</th>
							<th>Nombres</th>
							<th>Apellidos</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>	
			</div>
		</div>
		
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	</div>
</div>




<script type="text/javascript">

//modalBs.modal('hide');

var modal = $('#DetalleAccMod');

$(function(){

	table[1] = $('#gridDetalleaccmod').DataTable( {
		"language": {
			"url": "{!!route('espanol')!!}"
		},
		ajax: {
			url: "{!!route('gridDetalleaccmodRFID', ['mod_id'=>$query->mod_id])!!}",
			"type": "POST"
		},
		columns: [ {data:'aut_id'},{data:'getfuncionario.tdocumento.tdoc_sigla'}, {data:'getfuncionario.func_documento'}, {data:'getfuncionario.func_nombres'}, {data:'getfuncionario.func_apellidos'}],
		"columnDefs": [
		{
			"targets": [0],
			"visible": false,
			"searchable": false
		},
		],
		"scrollX": true,
	} );

});



</script>