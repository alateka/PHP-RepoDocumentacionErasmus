<?php

namespace Tests\Feature\User;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Ciclo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserValidationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    function name_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  '',
            'last_name' => 'paco',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '11111111A',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $this->assertDatabaseMissing('users', [
            'last_name'  =>  'paco'
        ]);
    }

    /** @test */
    function last_name_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => '',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '11111111A',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  =>  'pepe'
        ]);
    }

    /** @test */
    function email_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => 'paco',
            'email' => '',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '11111111A',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  =>  'pepe'
        ]);
    }

    /** @test */
    function email_is_unique(){

        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'name'  =>  'paco',
            'last_name' => 'pepe',
            'admin'     => 0,
            'ciclo_id' => $ciclo->id,
            'email'   =>  'hola@hola.es',
            'verified' => 0]);

        $this->post('/register',[
            'name'  =>  '',
            'last_name' => 'paco',
            'email' => 'hola@hola.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '11111111A',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ])->assertSessionHasErrors('email');
    }

    /** @test */
    function password_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => 'paco',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '11111111A',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "",
            "password_confirmation" => "",
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  =>  'pepe'
        ]);
    }

    /** @test */
    function fecha_nacimiento_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => 'paco',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '',
            'dni' => '11111111A',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  =>  'pepe'
        ]);
    }

    /** @test */
    function ciclo_id_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => 'paco',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '11111111A',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  =>  'pepe'
        ]);
    }

    /** @test */
    function dni_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => 'paco',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  =>  'pepe'
        ]);
    }

    /** @test */
    function dni_is_unique(){

        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'name'  =>  'paco',
            'last_name' => 'pepe',
            'admin'     => 0,
            'ciclo_id' => $ciclo->id,
            'dni'   =>  '123456789',
            'verified' => 0]);

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => 'paco',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '123456789',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ])->assertSessionHasErrors('dni');


    }

    /** @test */
    function year_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => 'paco',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '11111111A',
            'year' => '',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  =>  'pepe'
        ]);
    }
    /** @test */
    function telefono_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => 'paco',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '11111111A',
            'year' => '2019/2020',
            'telefono' => '',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  =>  'pepe'
        ]);
    }
    /** @test */
    function localidad_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => 'paco',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '11111111A',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => '',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  =>  'pepe'
        ]);
    }
    /** @test */
    function cp_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => 'paco',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '11111111A',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  =>  'pepe'
        ]);
    }
    /** @test */
    function direccion_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => 'paco',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '11111111A',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => '',
            'cp' => '30880',
            'nacionalidad' => 'España',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  =>  'pepe'
        ]);
    }

    /** @test */
    function nacionalidad_is_required(){

        $ciclo = Ciclo::factory()->create();

        $this->post('/register',[
            'name'  =>  'pepe',
            'last_name' => 'paco',
            'email' => 'pasdasdhjkasd@mail.es',
            'ciclo' => "$ciclo->id",
            'fecha_nacimiento' => '1991-07-29',
            'dni' => '11111111A',
            'year' => '2019/2020',
            'telefono' => '666666666',
            'localidad' => 'Prueba',
            'direccion' => 'Prueba',
            'cp' => '30880',
            'nacionalidad' => '',
            'password' => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  =>  'pepe'
        ]);
    }

}
