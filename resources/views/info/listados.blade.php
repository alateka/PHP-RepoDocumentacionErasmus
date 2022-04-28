@extends('layouts.layout')

@section('title', 'Listados')

@section('css')
<link rel="stylesheet" href="{{asset('css/documentos.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection


@section('content')
    <h1 class="text-center mt-5" style="color: #1f4568; font-size:3em"><b>Listados de años anteriores</b></h1>


    <div class="justify-content-center m-5">
        <table class="example" class="col-10 table table-hover">
            <thead class="bg-light">
            <tr>
                <th>2020-2021</th>
                <th>Enlace<span class=" ml-2 fas fa-file-download"></span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Listado provisional Grado Medio</th>
                <td><a href="{{asset("/info/lists/baremacion_Erasmus_Grados_Medio_20-21.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            <tr>
                <th scope="row">Listado provisional Grado Superior</th>
                <td><a href="{{asset("/info/lists/baremacion_Erasmus_Grados_Superior_20-21.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            <tr>
                <th scope="row">Listado definitivo Grado Medio</th>
                <td><a href="{{asset("/info/lists/baremacion_Erasmus_Grados_Medio__definitivo_20-21.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            <tr>
                <th scope="row">Listado definitivo Grado Superior</th>
                <td><a href="{{asset("/info/lists/baremacion_Erasmus_Grados_Superior_definitivo_20-21.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="justify-content-center m-5">
        <table class="example" class="col-10 table table-hover">
            <thead class="bg-light">
            <tr>
                <th>2019-2020</th>
                <th>Enlace<span class=" ml-2 fas fa-file-download"></span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Listado provisional Grado Superior</th>
                <td><a href="{{asset("/info/lists/listaProvisional_erasmus_19-20.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            <tr>
                <th scope="row">Listado definitivo Grado Superior</th>
                <td><a href="{{asset("/info/lists/adjudicacionBecasErasmus19-20.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            </tbody>
        </table>
    </div>


    <div class="justify-content-center m-5">
        <table class="example" class="col-10 table table-hover">
            <thead class="bg-light">
            <tr>
                <th>2018-2019</th>
                <th>Enlace<span class=" ml-2 fas fa-file-download"></span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Listado provisional Grado Medio</th>
                <td><a href="{{asset("/info/lists/Baremacion_erasmus_18-19GM.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            <tr>
                <th scope="row">Listado provisional Grado Superior</th>
                <td><a href="{{asset("/info/lists/Baremacion_erasmus_18-19GS.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            <tr>
                <th scope="row">Listado definitivo Grado Medio</th>
                <td><a href="{{asset("/info/lists/BaremacionErasmusDefinitiva18-19GM.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            <tr>
                <th scope="row">Listado definitivo Grado Superior</th>
                <td><a href="{{asset("/info/lists/BaremacionErasmusDefinitiva_18-19GS.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="justify-content-center m-5">
        <table class="example" class="col-10 table table-hover">
            <thead class="bg-light">
            <tr>
                <th>2017-2018</th>
                <th>Enlace<span class=" ml-2 fas fa-file-download"></span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Listado provisional Grado Medio</th>
                <td><a href="{{asset("/info/lists/Listado_Baremacion_Provisional_GM_erasmus_17-18.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            <tr>
                <th scope="row">Listado provisional Grado Superior</th>
                <td><a href="{{asset("/info/lists/Listado_Baremacion_Provisional_GS_erasmus_17-18.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            <tr>
                <th scope="row">Listado definitivo Grado Medio</th>
                <td><a href="{{asset("/info/lists/LISTADO DEFINITIVO PARTICIPACION ALUMNOS GRADO MEDIO.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
            </tr>
            <tr>
                <th scope="row">Listado definitivo Grado Superior</th>
                <td><a href="{{asset("/info/lists/LISTADO DEFINITIVO PARTICIPACION ALUMNOS GRADO SUPERIOR.pdf")}}" target="_blank" class="btn btn-info">Descargar</a></td>
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
            $('.example').DataTable({
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
                    { "bSortable": false, "targets": 1 },
                ],
            });

            $(".example").css("width","80%");
            $("input").css("margin-right", "auto")
        } );
    </script>
@endsection
