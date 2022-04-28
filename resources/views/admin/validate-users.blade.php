    @extends('adminlte::page')

    @section('title', 'Validación de usuarios')

    @section('plugins.Select2', true)

    @section('content_header')
        <h3 class="text-center" style="font-size: 3em; font-weight: 600">Validación de usuarios</h3>
    @stop

    @section('content')
       @livewire('validate-users-table')
    @stop

    @section('css')
        <link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}"> 
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

        <style>
            body{
                overflow-y: scroll;
	            overflow-x: hidden;
                }
        </style>
    @stop

    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        @if(session('delete'))
            <script>
                Swal.fire(
                    'Usuario eliminado.',
                    'El usuario fue eliminado correctamente.',
                    'success'
                    )
            </script>
        @elseif(session('verify'))
            <script>
                Swal.fire(
                    'Usuario validado.',
                    'El usuario fue validado correctamente.',
                    'success'
                    )
            </script>
        @endif
        <script>

            $(".form-delete").submit(function(e){
                e.preventDefault();
                
                Swal.fire({
                    title: '¿Está seguro de que desea borrar el usuario seleccionado?',
                    text: "No podrá revertir este cambio.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            })

        </script>
    @stop
