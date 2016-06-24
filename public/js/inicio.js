
/*permite procedimientos ajax para laravel*/
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


var table = [];



var modalBs = $('#modalBs');
var modalBsContent = $('#modalBs').find(".modal-content");


$(function(){

    /*elimina boton de seleccion de filtros de la grid*/

    $('span[unselectable].k-dropdown-wrap.k-state-default').removeAttr('style');
    $('table .k-dropdown-wrap.k-state-default').css('display','none');
    handleAjaxModal();

    $(".animacarga").hide();

    $(document).on('mouseover','table a[data-modal]', function(){
        handleAjaxModal();
    })
})




function handleAjaxModal() {

    // Limpia los eventos asociados para elementos ya existentes, asi evita duplicación
    $("a[data-modal]").unbind("click");
    // Evita cachear las transaccione Ajax previas
    $.ajaxSetup({ cache: false });

    // Configura evento del link para aquellos para los que desean abrir popups
    $("a[data-modal]").on("click", function (e) {
        var dataModalValue = $(this).data("modal");

        var dataid = $(this).attr('data-id');
        var url = "";
        if(dataid){
            index = $(this).attr('table') != ''? $(this).attr('table') : 0;
            var data = table[index].row( $(this).parents('tr') ).data();
            url = this.href+"?id="+data[dataid];
        }else{
            url = this.href;
        }

        modalBsContent.load(url, function (response, status, xhr) {
            switch (status) {
                case "success":
                modalBs.modal({ backdrop: 'static', keyboard: false }, 'show');

                if (dataModalValue == "modal-lg") {
                    modalBs.find(".modal-dialog").addClass("modal-lg");
                } else {
                    modalBs.find(".modal-dialog").removeClass("modal-lg");
                }

                break;

                case "error":
                var message = "Error de ejecución: " + xhr.status + " " + xhr.statusText;
                if (xhr.status == 403) $.msgbox(response, { type: 'error' });
                else $.msgbox(message, { type: 'error' });
                break;
            }

        });
        return false;
    });
}


function EventoFormularioModal(modal, onSuccess, oneError) {
    modal.find('form').submit(function () {
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
    });
}


//Se utiliza para que el campo de texto solo acepte letras
function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

function limpia() {
    var val = document.getElementById("miInput").value;
    var tam = val.length;
    for(i = 0; i < tam; i++) {
        if(!isNaN(val[i]))
            document.getElementById("miInput").value = '';
    }
}


function solocodigos(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "abcdef0123456789";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}




//Se utiliza para que el campo de texto solo acepte numeros
function SoloNumeros(evt){
 if(window.event){//asignamos el valor de la tecla a keynum
  keynum = evt.keyCode; //IE
 }
 else{
  keynum = evt.which; //FF
 } 
 //comprobamos si se encuentra en el rango numérico y que teclas no recibirá.
 if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 6 ){
  return true;
 }
 else{
  return false;
 }
}