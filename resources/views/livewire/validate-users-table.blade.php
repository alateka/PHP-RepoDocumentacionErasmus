<div>
  <div class="justify-content-center m-3">


    <div class="form-row justify-content-center mb-5">
      <div class="col-sm-12 col-lg-2">
        <select style="font-size: .8em" class="form-control rounded" wire:model="paginate">
            <option selected value="25">Usuarios por página:</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">50</option>
        </select>
      </div>   
      <input wire:model="search" class="form-control col-sm-12 col-lg-2 rounded text-gray-500 mr-2" type="text" placeholder="Buscar usuario">
      <button wire:click="clearFilters" class="float-right mr-2 btn btn-dark">Vaciar filtros</button>
    </div>


    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              @if(count($users))
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre
                      </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Apellidos
                      </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Grado
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Ciclo
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Validar
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  @foreach($users as $u)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=<?=$u->name?>&color=7F9CF5&background=EBF4FF" alt="">
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">
                            <?=$u->name?>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                          <?=$u->last_name?>
                        </div>
                    </td>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      <?=$u->ciclo->grado?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      <?=$u->ciclo->nombre?>
                    </td>
                    <td class="form-inline mt-3">
                        <form class="validate-user" action="{{ route('users.verify', $u->id)}}"  method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="verified" value="1">
                            <button type="submit" class="btn btn-success mr-1"><i class="fas fa-check"></i></button>
                        </form>
                        <form class="form-delete" action="{{ route('users.unvalidate', $u->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><i class="fas fa-times-circle"></i></button>
                        </form>
                    </td>
                  </tr>
                @endforeach 
                </tbody> 
              </table>
              
              @else
              <h1 style="font-size: 2em" class="text-center m-5">Ningún usuario encontrado</h1>
              @endif
            </div>
            <div style="margin-top: 20px; margin-bottom: 50px">
              {{ $users->links() }}
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
