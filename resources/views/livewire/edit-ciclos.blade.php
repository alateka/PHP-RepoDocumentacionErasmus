<div class="form-row justify-content-center">
    <div class="form-group col-sm-12 col-md-6">
        <label for="grado">Grado</label>
        <select class="form-control rounded" wire:model="grado">
            <option <?=($user->ciclo->grado == "Medio") ? 'selected' : ''?> value="Medio">Medio</option>
            <option <?=($user->ciclo->grado == "Superior") ? 'selected' : ''?> value="Superior">Superior</option>
        </select>
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="ciclo_id">Ciclo</label>
        <select class="form-control rounded" name="ciclo_id">
            @if($grado == "Medio")
                @foreach($ciclosGradoMedio as $cgm)
                    <option <?=($user->ciclo_id == $cgm->id) ? 'selected' : ''?> name="ciclo_id" value="{{$cgm->id}}">{{$cgm->nombre}}</option>
                @endforeach
            @elseif($grado == "Superior")
                @foreach($ciclosGradoSuperior as $cgs)
                    <option <?=($user->ciclo_id == $cgs->id) ? 'selected' : ''?> name="ciclo_id" value="{{$cgs->id}}">{{$cgs->nombre}}</option>
                @endforeach
            @endif
            </select>
     </div>
</div>



