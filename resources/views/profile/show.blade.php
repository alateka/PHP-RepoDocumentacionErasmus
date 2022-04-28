@livewire('navigation-menu')
<x-app-layout>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de control') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif
        </div>
    </div>

    <h3 class="text-center mb-5">Datos personales</h3>
    <div>
        <div class="row m-5 justify-content-center">
            <form  class="card p-5 form-update" method="POST" action="{{route('users.updateUser', $user)}}">
                
                @if ($errors->any())
                <div class="alert alert-danger">
                    <h4 style="font-weight: 800" class="mb-3">Se registraron los siguientes errores:</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @csrf
                @method('POST')
                <input type="hidden" name="user_id" value="<?=$user->id?>">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-3">
                        <label for="name">Nombre </label>
                        <input type="text" class="form-control" name="name" value="<?= $user->name?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-3">
                        <label for="last_name">Apellidos</label>
                        <input type="text" class="form-control" name="last_name" value="<?= $user->last_name ?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-3">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control" name="email" value="<?= $user->email ?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-3">
                        <label for="f_nac">Fecha de nacimiento</label>
                        <input type="date" class="form-control" name="fecha_nacimiento" value="<?= $user->fecha_nacimiento?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="dni">DNI/NIE</label>
                        <input type="text" class="form-control" name="dni" value="<?= $user->dni?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="nacionalidad">Nacionalidad</label>
                        <select class="form-control rounded" required style="width: 100%" name="nacionalidad" id="nacionalidad">
                            <option disabled selected>Nacionalidad</option>
                            <option value="Alemania" <?= ("Alemania" == $user->nacionalidad) ? 'selected' : ''?>>Alemania</option>
                            <option value="Austria"  <?= ("Austria" == $user->nacionalidad) ? 'selected' : ''?>>Austria</option>
                            <option value="Bélgica"  <?= ("Bélgica" == $user->nacionalidad) ? 'selected' : ''?>>Bélgica</option>
                            <option value="Bulgaria" <?= ("Bulgaria" == $user->nacionalidad) ? 'selected' : ''?>>Bulgaria</option>
                            <option value="Croacia" <?= ("Croacia" == $user->nacionalidad) ? 'selected' : ''?>>Croacia</option>
                            <option value="Dinamarca" <?= ("Dinamarca" == $user->nacionalidad) ? 'selected' : ''?> >Dinamarca</option>
                            <option value="Eslovaquia" <?= ("Eslovaquia" == $user->nacionalidad) ? 'selected' : ''?>>Eslovaquia</option>
                            <option value="Eslovenia" <?= ("Eslovenia" == $user->nacionalidad) ? 'selected' : ''?>>Eslovenia</option>
                            <option value="España" <?= ("España" == $user->nacionalidad) ? 'selected' : ''?> >España</option>
                            <option value="Estonia"  <?= ("Estonia" == $user->nacionalidad) ? 'selected' : ''?>>Estonia</option>
                            <option value="Finlandia" <?= ("Finlandia" == $user->nacionalidad) ? 'selected' : ''?> >Finlandia</option>
                            <option value="Francia" <?= ("Francia" == $user->nacionalidad) ? 'selected' : ''?>>Francia</option>
                            <option value="Grecia" <?= ("Grecia" == $user->nacionalidad) ? 'selected' : ''?> >Grecia</option>
                            <option value="Hungría" <?= ("Hungría" == $user->nacionalidad) ? 'selected' : ''?>>Hungría</option>
                            <option value="Irlanda" <?= ("Irlanda" == $user->nacionalidad) ? 'selected' : ''?>>Irlanda</option>
                            <option value="Italia" <?= ("Italia" == $user->nacionalidad) ? 'selected' : ''?>>Italia</option>
                            <option value="Letonia" <?= ("Letonia" == $user->nacionalidad) ? 'selected' : ''?>>Letonia</option>
                            <option value="Lituania" <?= ("Lituania" == $user->nacionalidad) ? 'selected' : ''?>>Lituania</option>
                            <option value="Luxemburgo" <?= ("Luxemburgo" == $user->nacionalidad) ? 'selected' : ''?>>Luxemburgo</option>
                            <option value="Malta" <?= ("Malta" == $user->nacionalidad) ? 'selected' : ''?>>Malta</option>
                            <option value="Países Bajos" <?= ("Países Bajos" == $user->nacionalidad) ? 'selected' : ''?>>Países Bajos</option>
                            <option value="Polonia" <?= ("Polonia" == $user->nacionalidad) ? 'selected' : ''?>>Polonia</option>
                            <option value="Portugal" <?= ("Portugal" == $user->nacionalidad) ? 'selected' : ''?>>Portugal</option>
                            <option value="Rumanía" <?= ("Rumanía" == $user->nacionalidad) ? 'selected' : ''?>>Rumanía</option>
                            <option value="Suecia" <?= ("Suecia" == $user->nacionalidad) ? 'selected' : ''?>>Suecia</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="localidad">Localidad</label>
                        <input type="text" class="form-control" name="localidad" value="<?= $user->localidad?>">
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group col-sm-12 col-md-4">
                        <label>Domicilio</label>
                        <input type="text" class="form-control" name="direccion" value="<?= $user->direccion?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="codigo_postal">Código postal</label>
                        <input type="text" class="form-control" name="cp" value="<?= $user->cp?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="phone">Telefono de contacto</label>
                        <input type="tel" class="form-control" name="telefono" value="<?= $user->telefono?>">
                    </div>
                </div>
                <div class="form-row">

                </div>


                    @livewire('edit-ciclos')
                <button type="submit" style="font-size:.7em; font-weight:800" class="boton align-self-center p-2 mt-5 btn btn-primary">ACTUALIZAR DATOS</button>
            </form>
        </div>

    </div>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
