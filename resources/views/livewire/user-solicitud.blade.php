<div>
    <div class="row mt-5 justify-content-center">
        @if($user->solicitud)
            <form class="card p-5 m-3" method="POST" action="{{route('solicitud.updateUser')}}">
                <input type="hidden" name="solicitud_id" value="<?=$user->solicitud->id?>">
        @else
            <form class="card p-5 m-3" method="POST" action="{{route('solicitud.create')}}">
        @endif
            <input type="hidden" name="user_id" value="<?=$user->id?>">
            @csrf
            <h2 style="font-size: 3em; font-weight: 700;" class="text-center mb-5">Datos personales</h2>
            <div class="form-row">
                <div class="form-group col-sm-12 col-md-4">
                    <label for="full_name">Nombre y Apellidos</label>
                    <input type="text" class="form-control" name="full_name" value="<?= $user->name?> <?= $user->last_name?>" disabled>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="email">Correo</label>
                    <input type="email" class="form-control" name="email" value="<?= $user->email ?>" disabled>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="f_nac">Fecha de nacimiento</label>
                    <input type="text" class="form-control" name="f_nac" value="<?= $user->fecha_nacimiento?>" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-12 col-md-4">
                    <label for="dni">DNI/NIE</label>
                    <input type="text" class="form-control" name="dni" value="<?= $user->dni?>" disabled>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="nacionalidad">Nacionalidad</label>
                    <input type="text" class="form-control" name="nacionalidad" value="<?= $user->nacionalidad?>" disabled>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="localidad">Localidad</label>
                    <input <?=($user->solicitud) ? 'disabled' : ''?> type="text" class="form-control" value="<?= $user->localidad?>" disabled>
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-sm-12 col-md-4">
                    <label>Domicilio</label>
                    <input <?=($user->solicitud) ? 'disabled' : ''?> type="text" class="form-control" value="<?= $user->direccion?>" disabled>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="codigo_postal">Código postal</label>
                    <input <?=($user->solicitud) ? 'disabled' : ''?> type="text" class="form-control" value="<?= $user->cp?>" disabled>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="phone">Telefono de contacto</label>
                    <input <?=($user->solicitud) ? 'disabled' : ''?> type="tel" class="form-control" value="<?= $user->telefono?>" disabled>
                </div>
            </div>

            <hr>
            <h2 style="font-size: 3em; font-weight: 700;" class="text-center mt-5 mb-3">Datos académicos</h2>
            <div class="form-row">
                <div class="form-group col-sm-12 col-md-6">
                    <label for="grado">Grado</label>
                    <input type="text" class="form-control" name="grado" value="<?= $user->ciclo->grado?>" disabled>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="ciclo">Ciclo</label>
                    <input type="text" class="form-control" name="ciclo" value="<?= $user->ciclo->nombre?>" disabled>
                </div>
            </div>
            <hr>
            <h2 style="font-size: 3em; font-weight: 700;" class="text-center mt-5 mb-3">Idiomas</h2>
            <div class="form-check form-check-inline row justify-content-center">
                <div class="page__toggle">
                    <label class="toggle">
                        <input wire:model="ingles" class="toggle__input" type="checkbox" value="1" name="idiomas[]">
                        <span class="toggle__label">
                                    <span class="toggle__text">Ingles</span>
                                </span>
                    </label>
                </div>
                @if($ingles)
                    <div class="form-group col-sm-8 col-md-2">
                        <label for="nivel">Nivel</label>
                        <select class="form-control" name="nivel[]">
                            @if(isset($old_idiomas["Ingles"]))
                                <option <?=($old_idiomas["Ingles"] == "A1") ? 'selected' : ''?> value="A1">A1</option>
                                <option <?=($old_idiomas["Ingles"] == "A2") ? 'selected' : ''?> value="A2">A2</option>
                                <option <?=($old_idiomas["Ingles"] == "B1") ? 'selected' : ''?> value="B1">B1</option>
                                <option <?=($old_idiomas["Ingles"] == "B2") ? 'selected' : ''?> value="B2">B2</option>
                                <option <?=($old_idiomas["Ingles"] == "C1") ? 'selected' : ''?> value="C1">C1</option>
                                <option <?=($old_idiomas["Ingles"] == "C2") ? 'selected' : ''?> value="C2">C2</option>
                            @else
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                                <option value="B1">B1</option>
                                <option value="B2">B2</option>
                                <option value="C1">C1</option>
                                <option value="C2">C2</option>
                            @endif
                        </select>
                    </div>
                @endif
                <div class="page__toggle">
                    <label class="toggle">
                        <input wire:model="frances" class="toggle__input" type="checkbox" value="2" name="idiomas[]">
                        <span class="toggle__label">
                                    <span class="toggle__text">Francés</span>
                                </span>
                    </label>
                </div>
                @if($frances)
                    <div class="form-group col-sm-8 col-md-2">
                        <label for="nivel">Nivel</label>
                        <select class="form-control" name="nivel[]">
                            @if(isset($old_idiomas["Frances"]))
                                <option <?=($old_idiomas["Frances"] == "A1") ? 'selected' : ''?> value="A1">A1</option>
                                <option <?=($old_idiomas["Frances"] == "A2") ? 'selected' : ''?> value="A2">A2</option>
                                <option <?=($old_idiomas["Frances"] == "B1") ? 'selected' : ''?> value="B1">B1</option>
                                <option <?=($old_idiomas["Frances"] == "B2") ? 'selected' : ''?> value="B2">B2</option>
                                <option <?=($old_idiomas["Frances"] == "C1") ? 'selected' : ''?> value="C1">C1</option>
                                <option <?=($old_idiomas["Frances"] == "C2") ? 'selected' : ''?> value="C2">C2</option>
                            @else
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                                <option value="B1">B1</option>
                                <option value="B2">B2</option>
                                <option value="C1">C1</option>
                                <option value="C2">C2</option>
                            @endif
                        </select>
                    </div>
                @endif
                <div class="page__toggle">
                    <label class="toggle">
                        <input wire:model="aleman" class="toggle__input" type="checkbox" value="3" name="idiomas[]">
                        <span class="toggle__label">
                                    <span class="toggle__text">Alemán</span>
                                </span>
                    </label>
                </div>
                @if($aleman)
                    <div class="form-group col-sm-8 col-md-2">
                        <label for="nivel">Nivel</label>
                        <select class="form-control" name="nivel[]">
                            @if(isset($old_idiomas["Aleman"]))
                                <option <?=($old_idiomas["Aleman"] == "A1") ? 'selected' : ''?> value="A1">A1</option>
                                <option <?=($old_idiomas["Aleman"] == "A2") ? 'selected' : ''?> value="A2">A2</option>
                                <option <?=($old_idiomas["Aleman"] == "B1") ? 'selected' : ''?> value="B1">B1</option>
                                <option <?=($old_idiomas["Aleman"] == "B2") ? 'selected' : ''?> value="B2">B2</option>
                                <option <?=($old_idiomas["Aleman"] == "C1") ? 'selected' : ''?> value="C1">C1</option>
                                <option <?=($old_idiomas["Aleman"] == "C2") ? 'selected' : ''?> value="C2">C2</option>
                            @else
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                                <option value="B1">B1</option>
                                <option value="B2">B2</option>
                                <option value="C1">C1</option>
                                <option value="C2">C2</option>
                            @endif
                        </select>
                    </div>
                @endif
            </div>
            <div class="form-check form-check-inline row justify-content-center">
                <div class="page__toggle">
                    <label class="toggle">
                        <input wire:model="portugues" class="toggle__input" type="checkbox" value="4" name="idiomas[]">
                        <span class="toggle__label">
                                    <span class="toggle__text">Portugués</span>
                                </span>
                    </label>
                </div>
                @if($portugues)
                    <div class="form-group col-sm-8 col-md-3">
                        <label for="nivel">Nivel</label>
                        <select class="form-control" name="nivel[]">
                            @if(isset($old_idiomas["Portugues"]))
                                <option <?=($old_idiomas["Portugues"] == "A1") ? 'selected' : ''?> value="A1">A1</option>
                                <option <?=($old_idiomas["Portugues"] == "A2") ? 'selected' : ''?> value="A2">A2</option>
                                <option <?=($old_idiomas["Portugues"] == "B1") ? 'selected' : ''?> value="B1">B1</option>
                                <option <?=($old_idiomas["Portugues"] == "B2") ? 'selected' : ''?> value="B2">B2</option>
                                <option <?=($old_idiomas["Portugues"] == "C1") ? 'selected' : ''?> value="C1">C1</option>
                                <option <?=($old_idiomas["Portugues"] == "C2") ? 'selected' : ''?> value="C2">C2</option>
                            @else
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                                <option value="B1">B1</option>
                                <option value="B2">B2</option>
                                <option value="C1">C1</option>
                                <option value="C2">C2</option>
                            @endif
                        </select>
                    </div>
                @endif
                <div class="page__toggle">
                    <label class="toggle">
                        <input wire:model="italiano" class="toggle__input" type="checkbox" value="5" name="idiomas[]">
                        <span class="toggle__label">
                                    <span class="toggle__text">Italiano</span>
                                </span>
                    </label>
                </div>
                @if($italiano)
                    <div class="form-group col-sm-8 col-md-3">
                        <label for="nivel">Nivel</label>
                        <select class="form-control" name="nivel[]">
                            @if(isset($old_idiomas["Italiano"]))
                                <option <?=($old_idiomas["Italiano"] == "A1") ? 'selected' : ''?> value="A1">A1</option>
                                <option <?=($old_idiomas["Italiano"] == "A2") ? 'selected' : ''?> value="A2">A2</option>
                                <option <?=($old_idiomas["Italiano"] == "B1") ? 'selected' : ''?> value="B1">B1</option>
                                <option <?=($old_idiomas["Italiano"] == "B2") ? 'selected' : ''?> value="B2">B2</option>
                                <option <?=($old_idiomas["Italiano"] == "C1") ? 'selected' : ''?> value="C1">C1</option>
                                <option <?=($old_idiomas["Italiano"] == "C2") ? 'selected' : ''?> value="C2">C2</option>
                            @else
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                                <option value="B1">B1</option>
                                <option value="B2">B2</option>
                                <option value="C1">C1</option>
                                <option value="C2">C2</option>
                            @endif
                        </select>
                    </div>
                @endif
            </div>
            <hr>
            <h2 style="font-size: 3em; font-weight: 700;" class="text-center m-5">Información adicional</h2>
            <div class="form-row  justify-content-center">
                <div class="form-group col-sm-12 col-md-4">
                    <label for="codigo_postal">Beca MEC</label>
                    <select class="form-control" name="beca">
                        @if($user->solicitud)
                            <option <?=($user->solicitud->beca) ? 'selected' : ''?> value="0">No</option>
                            <option <?=($user->solicitud->beca) ? 'selected' : ''?> value="1">Si</option>
                        @else
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="codigo_postal">Carta de presentación</label>
                    <select class="form-control" name="carta">
                        @if($user->solicitud)
                            <option <?=($user->solicitud->carta) ? 'selected' : ''?> value="0">No</option>
                            <option <?=($user->solicitud->carta) ? 'selected' : ''?> value="1">Si</option>
                        @else
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="codigo_postal">Curriculum Vitae</label>
                    <select class="form-control" name="cv">
                        @if($user->solicitud)
                            <option <?=($user->solicitud->cv) ? 'selected' : ''?> value="0">No</option>
                            <option <?=($user->solicitud->cv) ? 'selected' : ''?> value="1">Si</option>
                        @else
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="codigo_postal">Cursos de formación</label>
                    <select class="form-control" name="cursos">
                        @if($user->solicitud)
                            <option <?=($user->solicitud->cursos) ? 'selected' : ''?> value="0">No</option>
                            <option <?=($user->solicitud->cursos) ? 'selected' : ''?> value="1">Si</option>
                        @else
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label>Presenta empresa</label>
                    <select wire:model="empresa" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                </div>
            </div>


            <div class="form-row justify-content-center">
                @if($empresa == "1")
                <div class="form-group col-12">
                    <label for="empresa">Nombre de la empresa</label>
                    @if ($user->solicitud)
                        <input type="text" name="empresa" class="form-control" name="empresa" value="<?= $user->solicitud->empresa?>">
                    @else
                        <input type="text" name="empresa" class="form-control" name="empresa" value="">
                    @endif
                </div>
                @endif
            </div>
            <hr>

            @if($user->solicitud)
                <div class="row justify-content-center">
                    <button type="submit" class="p-2 m-3 btn btn-primary">Actualizar solicitud</button>
                </div>
            @else
            <button type="submit" class="align-self-center w-25 mt-5 btn btn-primary">Enviar solicitud</button>
            @endif
        </form>
    </div>
    @if($user->solicitud)
        <form class="text-center" action="{{ route('solicitud.delete', $user->solicitud->id) }}" method="POST">
            @csrf
            @method('DELETE')
        <button type="submit" class="m-3 btn btn-danger">Eliminar solicitud</button>
        </form>
    @endif
</div>





