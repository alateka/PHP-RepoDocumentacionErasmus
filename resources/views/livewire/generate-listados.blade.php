<div>
    <div class="row m-5 justify-content-center">
        <form class="form-inline" action="{{route('listados.generate')}}">
            <label for="">Curso Escolar</label>
            <div class="select">
                <select name="year" id="format" wire:model="year">
                    <option selected value="">Seleccione año</option>
                    <option value="2018/2019">2018/2019</option>
                    <option value="2019/2020">2019/2020</option>
                    <option value="2020/2021">2020/2021</option>
                    <option value="2021/2022">2021/2022</option>
                </select>
             </div>
             <label for="">Grado</label>
             <div class="select">
                <select name="grado" id="format" wire:model="grado">
                    <option selected value="">Seleccione grado</option>
                        <option value="Medio">Medio</option>
                        <option value="Superior">Superior</option>
                </select>
             </div>
             <div class="m-3">
                <button @if(!$year || !$grado) disabled @else  @endif class="btn btn-info p-2">Generar listados</button>
            </div> 
        </form>
    </div>
</div>
