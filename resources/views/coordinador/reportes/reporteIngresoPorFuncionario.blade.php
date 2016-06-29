@extends('layouts.admin.principal')

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>
                Generación de Reportes
            </h3>
        </div>
    </div>

    <div class="clearfix"></div>


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Reporte de ingresos por funcionario:</h3>
        </div>
        <div class="panel-body">

            </br>

            <div class="row">
                <div class="col-md-2">Funcionario</div>
                <div class="col-md-10">
                    <input id="funcionario"/>
                </div>
            </div>

            </br>

            <div class="row">
                <div class="col-md-2">Sección</div>
                <div class="col-md-10">
                    <input id="seccion"/>
                </div>

            </div>

            </br>

            <div class="row">
                <div class="col-md-2">Fecha desde:</div>
                <div class="col-md-4">
                    <input id="fechaDesde" class="datepicker"/>
                </div>
                <div class="col-md-2">Fecha hasta:</div>
                <div class="col-md-4">
                    <input id="fechaHasta" class="datepicker"/>
                </div>
            </div>

            </br>

            <div class="row">
                <div class="col-md-2">Hora desde:</div>
                <div class="col-md-4">
                    <input id="horaDesde" class="timepicker"/>
                </div>
                <div class="col-md-2">Hora hasta:</div>
                <div class="col-md-4">
                    <input id="horaHasta" class="timepicker"/>
                </div>
            </div>

            </br>

            <div class="row">
                <button id="btnactualizar" class="btn btn-primary"
                        onclick="generar()">Generar Reporte
                </button>
            </div>

        </div>

    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-heading  text-right">
                <button id="btndescargar" style="display:none" class="btn btn-success"
                        onclick="obtenerReporteIngresoPorFuncionario()">Descargar Reporte
                </button>
            </div>
        </div>
        <div class="panel-body">
            <table id="reporte" class="table table-striped table-bordered no-footer" width="100%">
                <thead>
                <tr>
                    <th>Sección</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        var dataset;

        $(document).ready(function () {

            fechaDesde = $("#fechaDesde");
            fechaHasta = $("#fechaHasta");
            horaDesde = $("#horaDesde");
            horaHasta = $("#horaHasta");
            seccion = $("#seccion");
            btnDescargar = $("#btndescargar");
            funcionario = $("#funcionario");

            function startChange() {
                var startDate = start.value(),
                        endDate = end.value();

                if (startDate) {
                    startDate = new Date(startDate);
                    startDate.setDate(startDate.getDate());
                    end.min(startDate);
                } else if (endDate) {
                    start.max(new Date(endDate));
                } else {
                    endDate = new Date();
                    start.max(endDate);
                    end.min(endDate);
                }
            }

            function endChange() {
                var endDate = end.value(),
                        startDate = start.value();

                if (endDate) {
                    endDate = new Date(endDate);
                    endDate.setDate(endDate.getDate());
                    start.max(endDate);
                } else if (startDate) {
                    end.min(new Date(startDate));
                } else {
                    endDate = new Date();
                    start.max(endDate);
                    end.min(endDate);
                }
            }

            $("#seccion").kendoDropDownList({
                dataTextField: "mod_nombre",
                dataValueField: "mod_id",
                width: "40%",
                dataSource: {
                    transport: {
                        read: {
                            dataType: "json",
                            type: "POST",
                            url: "{!!route('getModulosDisponibles')!!}",
                        }
                    }
                },
                optionLabel: {
                    mod_nombre: "Seleccione...",
                    mod_id: ""
                }
            });

            $("#funcionario").kendoDropDownList({
                dataTextField: "func_nombres",
                dataValueField: "func_id",
                width: "40%",
                dataSource: {
                    transport: {
                        read: {
                            dataType: "json",
                            type: "POST",
                            url: "{!!route('getFuncionarioDisponibles')!!}",
                        }
                    }
                },
                optionLabel: {
                    func_nombres: "Seleccione...",
                    func_id: ""
                }
            });

            var start = $("#fechaDesde").kendoDatePicker({
                change: startChange,
                format: "yyyy-MM-dd"
            }).data("kendoDatePicker");

            var end = $("#fechaHasta").kendoDatePicker({
                change: endChange,
                format: "yyyy-MM-dd"
            }).data("kendoDatePicker");

            $(".timepicker").kendoTimePicker();

            start.max(end.value());
            end.min(start.value());
            inicializarFecha();


        });

        function inicializarFecha() {

            fechaDesde.val(moment().format('YYYY-MM-DD'));
            fechaHasta.val(moment().add(1, 'days').format('YYYY-MM-DD'));
        }

        function generar() {

            $('#reporte').DataTable().destroy();
            if (funcionario.val()) {
                var data = {
                    'fecha_desde': fechaDesde.val(),
                    'fecha_hasta': fechaHasta.val(),
                    'hora_desde': horaDesde.val(),
                    'hora_hasta': horaHasta.val(),
                    'modulo': seccion.val(),
                    'funcionario': funcionario.val()
                };

                $.post("{!!route('dataReporteIngresoPorFuncionario')!!}", data, function (result) {

                    result = JSON.parse(result);

                    if (result.estado) {

                        if (result.data.length > 0)
                            btnDescargar.css("display", "inline-block");
                        else
                            btnDescargar.css("display", "none");

                        $.msgbox(result.mensaje, {type: 'success'}, function () {

                            dataset = result.data;

                            table[0] = $('#reporte').DataTable({

                                "language": {
                                    "url": "{!!route('espanol')!!}"
                                },
                                data: result.data,
                                columns: [{data: 'modulo.mod_nombre'}, {data: 'acc_fecha'}, {data: 'acc_hora'}],
                                "scrollX": true
                            });
                        });
                    } else {
                        $.msgbox(result.mensaje, {type: 'error'}, function () {
                        });
                    }

                });
            } else {
                $.msgbox("Debes seleccionar un funcionario para generar el reporte.", {type: 'error'}, function () {
                });
            }

        }

        function obtenerReporteIngresoPorFuncionario() {
            $.post("{!!route('obtenerReporteIngresoPorFuncionario')!!}", {"data": dataset}, function (result) {
                location.href = "{{route('reportefuncionarioxls')}}";
            });
        }
    </script>

@endsection		