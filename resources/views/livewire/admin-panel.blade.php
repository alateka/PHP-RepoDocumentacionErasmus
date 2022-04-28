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
          
          <div class="col-sm-12 col-lg-1">
            <select style="font-size: .8em" class="form-control rounded"  wire:change="resetCiclo" wire:model="grado">
                <option selected value="">Grado:</option>
                <option value="Medio">Medio</option>
                <option value="Superior">Superior</option>
            </select>
          </div>
          
          @if($grado == "Medio")
          <div class="col-sm-12 col-lg-2">
            <select style="font-size: .8em" class="form-control rounded" wire:model="ciclo">
              <option selected value="">Todos</option>
              @foreach($ciclosGradoMedio as $cgm)
              <option value="{{$cgm->nombre}}">{{$cgm->nombre}}</option>
              @endforeach
            </select>
          </div>
  
          @elseif($grado == "Superior")
          <div class="col-sm-12 col-lg-2">
            <select style="font-size: .8em" class="form-control rounded" wire:model="ciclo">
              <option selected value="">Todos</option>
              @foreach($ciclosGradoSuperior as $cgs)
              <option value="{{$cgs->nombre}}">{{$cgs->nombre}}</option>
              @endforeach
            </select>
          </div>
          @endif
          <div class="col-sm-12 col-lg-1">
            <select style="font-size: .8em" class="form-control rounded" wire:model="year">
              <option selected value="">Curso:</option>
              <option value="2021/2022">2021/2022</option>
              <option value="2020/2021">2020/2021</option>
              <option value="2019/2020">2019/2020</option>
              <option value="2018/2019">2018/2019</option>
            </select>
          </div>

          <div class="col-sm-12 col-lg-1">
            <select style="font-size: .8em" class="form-control rounded" wire:model="solicitud">
              <option selected value="">Solicitud:</option>
              <option value="1">Sí</option>
              <option value="0">No</option>
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
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 font-black uppercase tracking-wider">
                        <a wire:click="sortable('name')" href="#">
                          Nombre
                          <span class="fa fa{{$camp === 'name' ? $icon : '-circle'}}"></span>
                        </a>
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 font-black uppercase tracking-wider">
                        <a wire:click="sortable('last_name')" href="#">
                          Apellidos
                          <span class="fa fa{{$camp === 'last_name' ? $icon : '-circle'}}"></span>
                        </a>
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 font-black uppercase tracking-wider">
                        <a wire:click="sortable('year')" href="#">
                          Curso
                          <span class="fa fa{{$camp === 'year' ? $icon : '-circle'}}"></span>
                        </a>
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 font-black uppercase tracking-wider">
                        <a wire:click="sortable('grado')" href="#">
                        Grado
                        <span class="fa fa{{$camp === 'grado' ? $icon : '-circle'}}"></span>
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 font-black uppercase tracking-wider">
                        <a wire:click="sortable('nombre')" href="#">
                        Ciclo
                        <span class="fa fa{{$camp === 'nombre' ? $icon : '-circle'}}"></span>
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 font-black uppercase tracking-wider">
                        Solicitud
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 font-black uppercase tracking-wider">
                        <a wire:click="sortable('baremo')" href="#">
                          Baremo
                          <span class="fa fa{{$camp === 'baremo' ? $icon : '-circle'}}"></span>
                        </a>
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 font-black uppercase tracking-wider">
                        Eliminar
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $u)
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="text-sm font-medium text-gray-900">
                              <?=$u->name?>
                            </div>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?=$u->last_name?></div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?=$u->year?>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?=$u->grado?>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?=$u->nombre?>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($u->user_id)
                        <a href="{{route('admin.solicitud', $u->id)}}" class="btn btn-secondary"><i class="far fa-eye mr-2"></i>Ver</a>
                        @else 
                        -
                        @endif
                      </td>
                      <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($u->user_id)
                        <?=$u->baremo?>
                        @else 
                        -
                        @endif
                      </td>
                      <td class="form-inline mt-4">
                        <form class="ml-4 form-delete" action="{{ route('users.delete', $u->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                        <button class="deleteUser focus:outline-none text-white text-sm py-2 px-3 border-b-4 border-red-600 rounded-md bg-red-500 hover:bg-red-400"><i class="far fa-trash-alt"></i></button>
                        </form>
                      </td>
                    </tr>
                  @endforeach 
                </tbody> 
                </table>
                @else
                <h1 style="font-size: 2em" class="text-center m-5">Ningún usuario encontrado</h1>
                @endif
                <div style="margin-top: 20px">
                  {{ $users->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
        
    </div>        
</div>



