<div>
    <div class="row m-5 justify-content-center">
        <form style="width: 70%" class="card p-5" action="{{route('documentos.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h5 style="font-size:2.5em; font-weight:800;"  class="text-center text-danger mb-5">Subida de documentos</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h2 style="font-weight: 800" class="mb-3">Se registraron los siguientes errores:</h2>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div>
                <div class="row justify-content-center">
                    <input style="border: 1.5px solid black; padding: .2em; border-radius: 5px" class="form-control w-50 m-3" type="file" name="files[]" multiple required>
                    <button type="submit" class="align-self-center p-2 btn btn-primary"><i class="fas fa-file-upload mr-2"></i>Subir documentos</button>
                </div>
            </div>
            
            
        </form>
    </div>

    <div class="row m-5 justify-content-center">
        @if(count($documentos))
        <table style="width: 70%">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="col-8 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Documento
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Descargar
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider float-right">
                Eliminar
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($documentos as $d)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?= $d->documento ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <a class="focus:outline-none text-white text-sm py-2 px-3 border-b-4 border-blue-600 rounded-md bg-blue-500 hover:bg-blue-400" href="{{ route('documents.download', $d->id) }}"><i class="fas fa-file-download"></i></a>
                </td>
                <td class="form-inline mt-4 float-right mr-4">
                <form class="form-delete mr-1" action="{{ route('documents.delete', $d->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                <button class="deleteUser focus:outline-none text-white text-sm py-2 px-3 border-b-4 border-red-600 rounded-md bg-red-500 hover:bg-red-400"><i class="far fa-trash-alt"></i></button>
                </form>
                </td>
            </tr>
            @endforeach 
        </tbody> 
        </table>
        @endif
    </div>
</div>
