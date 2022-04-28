@extends('layouts.layout')

@section('title', 'Documentos')

@section('css')
<link rel="stylesheet" href="{{asset('css/documentos.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection

@section('content')
<h1 class="text-center mb-5 mt-5" style="color: #1f4568; font-size:3em"><b>Listado de documentos</b></h1>


        <div class="row justify-content-center m-5">
            <table id="example" style="width: 70em" class="table table-hover">
                <thead class="bg-light">
                  <tr>
                    <th>Documento</th>
                    <th>Enlace<span class=" ml-2 fas fa-file-download"></span></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Solicitud de participación proyecto Erasmus+</th>
                    <td><a href="{{asset('info/docs/solicitud_estudiante_Erasmus_2020-21.doc')}}" class="btn btn-info">Descargar</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Renuncia a plaza Erasmus</th>
                    <td><a href="{{asset('info/docs/renuncia_plaza_erasmus_estudiantes_20-21.doc')}}" class="btn btn-info">Descargar</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Reclamación al baremo provisional</th>
                    <td><a href="{{asset('info/docs/reclamacion_al_baremo_provisional.doc')}}" class="btn btn-info">Descargar</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Plantilla de CV Europeo (Español)</th>
                    <td><a href="{{asset('info/docs/Plantilla_CV_español.doc')}}" class="btn btn-info">Descargar</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Plantilla de CV Europeo (Inglés)</th>
                    <td><a href="{{asset('info/docs/Plantilla_CV_ingles.doc')}}" class="btn btn-info">Descargar</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Enlace a Europass (ayuda para crear CV y carta de presentación)</th>
                    <td><a href="https://www.onlinecv.es/lp/europass/?utm_source=google&utm_medium=cpc&gclid=CjwKCAiAv4n9BRA9EiwA30WND8Yueh2XcQvujHmW4w6VfGsdNLL3KrZ0kcJ_P2k1-38zs6XleGN_UhoCZKQQAvD_BwE" target="_blank" class="btn btn-info">Ir a la web</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Instrucciones de CV Europeo</th>
                    <td><a href="{{asset('info/docs/CVInstructions.pdf')}}" target="_blank" class="btn btn-info">Descargar</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Niveles de competencia lingüística</th>
                    <td><a href="{{asset('info/docs/Niveles_competencia_linguistica.pdf')}}" target="_blank" class="btn btn-info">Descargar</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Ejemplo CV Europeo (1)</th>
                    <td><a href="{{asset('info/docs/CV-Example-1-es-ES.pdf')}}" target="_blank" class="btn btn-info">Descargar</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Ejemplo CV Europeo (2)</th>
                    <td><a href="{{asset('info/docs/CV-Example-2-es-ES.pdf')}}" target="_blank" class="btn btn-info">Descargar</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Recomendaciones carta y CV</th>
                    <td><a href="{{asset('info/docs/RECOMENDACIONES_CARTA Y CURRICULUM.pdf')}}" target="_blank" class="btn btn-info">Descargar</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Ejemplo de carta de motivación</th>
                    <td><a href="{{asset('info/docs/EJEMPLO_CARTA_MOTIVACION.pdf')}}" target="_blank" class="btn btn-info">Descargar</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Carta del estudiante Erasmus</th>
                    <td><a href="{{asset('info/docs/Carta_del_Estudiante_Superior.pdf')}}" target="_blank" class="btn btn-info">Descargar</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Recomendaciones generales Erasmus</th>
                    <td><a href="{{asset('info/docs/RECOMENDACIONES_GENERALES_ERASMUS.pdf')}}" target="_blank" class="btn btn-info">Descargar</a></td>
                  </tr>
                </tbody>
            </table>
        </div>
@endsection

@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#example').DataTable({
        "bPaginate": false,
        "info" : false,
        "bAutoWidth": false,
        "bFilter": false,
        "columnDefs": [
                    {"width": "90%", "targets": 0}
                ],
        "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Ningún resultado disponible",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Ningún resultado disponible",
            "search": "Buscar",
        },
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": 1 },
        ],
    });

    //$("#example").css("width","100%");
    $("input").css("margin-right", "auto")
} );
</script>
@endsection