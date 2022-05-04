
    @extends('adminlte::page')

    @section('title', 'Panel de administración')
    
    @section('content_header')
        <h3 class="text-center" style="font-size: 3em; font-weight: 800">Listado de usuarios</h3>
    @stop

    @section('content')
        <x-app-layout>
            <div class="py-12">
                <div class="mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        @livewire('admin-panel')
                    </div>
                </div>
            </div>
        </x-app-layout>
    @stop

    @section('css')
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
       
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



