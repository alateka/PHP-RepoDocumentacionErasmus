<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Ciclo;
use App\Models\User;

class UserUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function update_user()
    {
        $ciclo = Ciclo::factory()->create();
        $ciclo2 = Ciclo::factory()->create();

        $user = User::factory()->create([
            'name' => 'Agustin',
            'last_name' => 'Lopez',
            'email' => 'a@a.com',
            'fecha_nacimiento' => '1990-10-10',
            'ciclo_id' => $ciclo->id,
            'dni' => '123456789',
            'nacionalidad' => 'Francia',
            'telefono' => '111111111',
            'localidad' => 'Albacete',
            'direccion' => 'Calle de prueba',
            'cp' => '1520',
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => 'Paco',
            'last_name' => 'Pepe',
            'email' => 'pepe@pepe.com',
            'fecha_nacimiento' => '2000-10-10',
            'ciclo_id' => $ciclo2->id,
            'dni' => '987654321',
            'nacionalidad' => 'España',
            'telefono' => '999999999',
            'localidad' => 'Cuenca',
            'direccion' => 'Calle actualizada',
            'cp' => '2021',
        ])->assertRedirect('/home');

        $this->assertDatabaseHas('users',[
            'name' => 'Paco',
            'last_name' => 'Pepe',
            'email' => 'pepe@pepe.com',
            'fecha_nacimiento' => '2000-10-10',
            'ciclo_id' => $ciclo2->id,
            'dni' => '987654321',
            'nacionalidad' => 'España',
            'telefono' => '999999999',
            'localidad' => 'Cuenca',
            'direccion' => 'Calle actualizada',
            'cp' => '2021',
        ]);

    }


    /** @test */
    public function update_name_required()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'name'  =>  'paco',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => '',
            'last_name' => $user->last_name,
            'email' => $user->email,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'ciclo_id' => $user->ciclo_id,
            'dni' => $user->dni,
            'nacionalidad' => $user->nacionalidad,
            'telefono' => $user->telefono,
            'localidad' => $user->localidad,
            'direccion' => $user->direccion,
            'cp' => $user->cp,
        ])->assertSessionHasErrors('name');

        $this->assertDatabaseHas('users',[
            'name'  =>  'paco'
        ]);

    }

    /** @test */
    public function update_last_name_required()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'last_name'  =>  'paco',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => '',
            'email' => $user->email,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'ciclo_id' => $user->ciclo_id,
            'dni' => $user->dni,
            'nacionalidad' => $user->nacionalidad,
            'telefono' => $user->telefono,
            'localidad' => $user->localidad,
            'direccion' => $user->direccion,
            'cp' => $user->cp,
        ])->assertSessionHasErrors('last_name');

        $this->assertDatabaseHas('users',[
            'last_name'  =>  'paco',
        ]);

    }

    /** @test */
    public function update_email_required()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'email'  =>  'hola@hola.com',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);

        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => '',
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'ciclo_id' => $user->ciclo_id,
            'dni' => $user->dni,
            'nacionalidad' => $user->nacionalidad,
            'telefono' => $user->telefono,
            'localidad' => $user->localidad,
            'direccion' => $user->direccion,
            'cp' => $user->cp,
        ])->assertSessionHasErrors('email');

        $this->assertDatabaseHas('users',[
            'email'  =>  'hola@hola.com'
        ]);

    }

    /** @test */
    public function update_email_unique()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'email'  =>  'hola@hola.es',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);

        User::factory()->create([
            'email'  =>  'cambio@hola.es',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => 'cambio@hola.es',
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'ciclo_id' => $user->ciclo_id,
            'dni' => $user->dni,
            'nacionalidad' => $user->nacionalidad,
            'telefono' => $user->telefono,
            'localidad' => $user->localidad,
            'direccion' => $user->direccion,
            'cp' => $user->cp,
        ])->assertSessionHasErrors('email');

        $this->assertDatabaseHas('users',[
            'email'  =>  'hola@hola.es'
        ]);

    }

    /** @test */
    public function update_fecha_nacimiento_required()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'fecha_nacimiento'  =>  '1995-05-06',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'fecha_nacimiento' => '',
            'ciclo_id' => $user->ciclo_id,
            'dni' => $user->dni,
            'nacionalidad' => $user->nacionalidad,
            'telefono' => $user->telefono,
            'localidad' => $user->localidad,
            'direccion' => $user->direccion,
            'cp' => $user->cp,
        ])->assertSessionHasErrors('fecha_nacimiento');

        $this->assertDatabaseHas('users',[
            'fecha_nacimiento'  =>  '1995-05-06'
        ]);

    }

    /** @test */
    public function the_fecha_nacimiento_field_must_be_date_type()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'fecha_nacimiento'  =>  '1995-05-06',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'fecha_nacimiento' => 'fecha-erronea',
            'ciclo_id' => $user->ciclo_id,
            'dni' => $user->dni,
            'nacionalidad' => $user->nacionalidad,
            'telefono' => $user->telefono,
            'localidad' => $user->localidad,
            'direccion' => $user->direccion,
            'cp' => $user->cp,
        ])->assertSessionHasErrors('fecha_nacimiento');

        $this->assertDatabaseHas('users',[
            'fecha_nacimiento'  =>  '1995-05-06'
        ]);

    }

    /** @test */
    public function update_ciclo_id_required()
    {
        $ciclo = Ciclo::factory()->create();


        $user = User::factory()->create([
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'ciclo_id' => '',
            'dni' => $user->dni,
            'nacionalidad' => $user->nacionalidad,
            'telefono' => $user->telefono,
            'localidad' => $user->localidad,
            'direccion' => $user->direccion,
            'cp' => $user->cp,
        ])->assertSessionHasErrors('ciclo_id');

        $this->assertDatabaseHas('users',[
            'ciclo_id'  =>  $ciclo->id,
        ]);

    }

    /** @test */
    public function update_dni_required()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'dni'  =>  '11111111A',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'ciclo_id' => $user->ciclo_id,
            'dni' => '',
            'nacionalidad' => $user->nacionalidad,
            'telefono' => $user->telefono,
            'localidad' => $user->localidad,
            'direccion' => $user->direccion,
            'cp' => $user->cp,
        ])->assertSessionHasErrors('dni');

        $this->assertDatabaseHas('users',[
            'dni'  =>  '11111111A'
        ]);

    }

    /** @test */
    public function update_dni_unique()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'dni'  =>  '11111111A',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);

        User::factory()->create([
            'dni'  =>  '11111111B',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'ciclo_id' => $user->ciclo_id,
            'dni' => '11111111B',
            'nacionalidad' => $user->nacionalidad,
            'telefono' => $user->telefono,
            'localidad' => $user->localidad,
            'direccion' => $user->direccion,
            'cp' => $user->cp,
        ])->assertSessionHasErrors('dni');

        $this->assertDatabaseHas('users',[
            'dni'  =>  '11111111A'
        ]);

    }

    /** @test */
    public function update_nacionalidad_required()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'nacionalidad'  =>  'España',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'ciclo_id' => $user->ciclo_id,
            'dni' => $user->dni,
            'nacionalidad' => '',
            'telefono' => $user->telefono,
            'localidad' => $user->localidad,
            'direccion' => $user->direccion,
            'cp' => $user->cp,
        ])->assertSessionHasErrors('nacionalidad');

        $this->assertDatabaseHas('users',[
            'nacionalidad'  =>  'España'
        ]);

    }

    /** @test */
    public function update_telefono_required()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'telefono'  =>  '968111111',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'ciclo_id' => $user->ciclo_id,
            'dni' => $user->dni,
            'nacionalidad' => $user->nacionalidad,
            'telefono' => '',
            'localidad' => $user->localidad,
            'direccion' => $user->direccion,
            'cp' => $user->cp,
        ])->assertSessionHasErrors('telefono');

        $this->assertDatabaseHas('users',[
            'telefono'  =>  '968111111'
        ]);

    }

    /** @test */
    public function update_localidad_required()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'localidad'  =>  'Asturias',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'ciclo_id' => $user->ciclo_id,
            'dni' => $user->dni,
            'nacionalidad' => $user->nacionalidad,
            'telefono' => $user->telefono,
            'localidad' => '',
            'direccion' => $user->direccion,
            'cp' => $user->cp,
        ])->assertSessionHasErrors('localidad');


        $this->assertDatabaseHas('users',[
            'localidad'  =>  'Asturias'
        ]);

    }

    /** @test */
    public function update_direccion_required()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'direccion'  =>  'Asturias',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'ciclo_id' => $user->ciclo_id,
            'dni' => $user->dni,
            'nacionalidad' => $user->nacionalidad,
            'telefono' => $user->telefono,
            'localidad' => $user->localidad,
            'direccion' => '',
            'cp' => $user->cp,
        ])->assertSessionHasErrors('direccion');

        $this->assertDatabaseHas('users',[
            'direccion'  =>  'Asturias'
        ]);

    }

    /** @test */
    public function update_postal_code_required()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'cp'  =>  '00000',
            'ciclo_id' => $ciclo->id,
            'verified' => 1,
        ]);
        $this->actingAs($user);

        $this->post('/user/profile',[
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'ciclo_id' => $user->ciclo_id,
            'dni' => $user->dni,
            'nacionalidad' => $user->nacionalidad,
            'telefono' => $user->telefono,
            'localidad' => $user->localidad,
            'direccion' => $user->direccion,
            'cp' => '',
        ])->assertSessionHasErrors('cp');

        $this->assertDatabaseHas('users',[
            'cp'  =>  '00000',
        ]);

    }


}
