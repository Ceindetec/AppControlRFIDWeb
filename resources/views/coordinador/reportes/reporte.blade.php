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
            <h3 class="panel-title">Reportes</h3>
        </div>
        <div class="panel-body">
            <h4>Reporte por fechas:</h4>
            <p>Desde:
                <input id="fechaDesde" class="datepicker"/>
            </p>
            <p>Hasta:
                <input id="fechaHasta" class="datepicker"/>
            </p>
            <button id="btnactualizar" class="btn btn-primary"
                    onclick="generar()">Generar Reporte
            </button>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function () {

            fechaDesde = $("#fechaDesde");
            fechaHasta = $("#fechaHasta");

            function inicializarFecha() {

                fechaDesde.val(moment().format('DD/MM/YYYY'));
                fechaHasta.val(moment().add(1, 'days').format('DD/MM/YYYY'));
            }

            function generar() {

                var data = {'fecha_desde':fechaDesde.val(),'fechaHasta':fechaHasta.val()};

                $.post("{!!route('generarReporteIngresoFuncionario')!!}", data, function (result) {

                });
            }

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

            var start = $("#fechaDesde").kendoDatePicker({
                change: startChange
            }).data("kendoDatePicker");

            var end = $("#fechaHasta").kendoDatePicker({
                change: endChange
            }).data("kendoDatePicker");

            start.max(end.value());
            end.min(start.value());

        });

    </script>

@endsection