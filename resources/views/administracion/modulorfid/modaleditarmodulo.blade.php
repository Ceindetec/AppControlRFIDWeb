<div id="Editarmodulo">
 {!!Form::model($data)!!}
 <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4> Editar modulo RFID</h4>
</div>
<div class="modal-body">
  <input type="hidden" name="mod_id" value="{!!$data->mod_id!!}">
  <div class="form-group">
    {!!Form::label('codigo modulo RFID (*)')!!}
    {!!Form::text('mod_codigo',null,['class'=>'form-control', 'required', 'maxlength'=>'8'])!!}
  </div>
  <div class="form-group">
    {!!Form::label('Nombre oficina (*)')!!}
    {!!Form::text('mod_nombre',null,['class'=>'form-control', 'required', 'maxlength'=>'45'])!!}
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

var modal = $('#Editarmodulo');

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