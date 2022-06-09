<?php

namespace Tests\Feature\Solicitud;

use App\Models\Ciclo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateSolicitudTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    Use RefreshDatabase;

    /** @test */
    public function create_solicitud()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'name'  =>  'paco',
            'last_name' => 'pepe',
            'admin'     => 0,
            'ciclo_id' => $ciclo->id,
            'verified' => 1]);
        $this->actingAs($user);

        $this->post('/solicitud',[
           'user_id'    =>  $user->id,
            'empresa' => 'IES CIERVA',
            'carta' => '1',
            'cv' => '0',
            'beca' => '1',
            'cursos' => '0',
            'recien_titulado' => '1'
        ])->assertRedirect('/home');

        $this->get('/home')
            ->assertSee('Subir documentos');

        $this->assertDatabaseHas('solicitudes', [
            'user_id' => $user->id,

        ]);
    }

    /** @test */
    public function carta_is_boolean()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'name'  =>  'paco',
            'last_name' => 'pepe',
            'admin'     => 0,
            'ciclo_id' => $ciclo->id,
            'verified' => 1]);
        $this->actingAs($user);

        $this->post('/solicitud',[
            'user_id'    =>  $user->id,
            'empresa' => 'IES CIERVA',
            'carta' => '',
            'cv' => '0',
            'beca' => '1',
            'cursos' => '0',
            'recien_titulado' => '1'
        ])->assertSessionHasErrors('carta');

        $this->assertDatabaseMissing('solicitudes', [
            'user_id' => $user->id,

        ]);
    }

    /** @test */
    public function cv_is_boolean()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'name'  =>  'paco',
            'last_name' => 'pepe',
            'admin'     => 0,
            'ciclo_id' => $ciclo->id,
            'verified' => 1]);
        $this->actingAs($user);

        $this->post('/solicitud',[
            'user_id'    =>  $user->id,
            'empresa' => 'IES CIERVA',
            'carta' => '1',
            'cv' => '',
            'beca' => '1',
            'cursos' => '0',
            'recien_titulado' => '1'
        ])->assertSessionHasErrors('cv');

        $this->assertDatabaseMissing('solicitudes', [
            'user_id' => $user->id,

        ]);
    }

    /** @test */
    public function beca_is_boolean()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'name'  =>  'paco',
            'last_name' => 'pepe',
            'admin'     => 0,
            'ciclo_id' => $ciclo->id,
            'verified' => 1]);
        $this->actingAs($user);

        $this->post('/solicitud',[
            'user_id'    =>  $user->id,
            'empresa' => 'IES CIERVA',
            'carta' => '1',
            'cv' => '0',
            'beca' => '',
            'cursos' => '0',
            'recien_titulado' => '1'
        ])->assertSessionHasErrors('beca');

        $this->assertDatabaseMissing('solicitudes', [
            'user_id' => $user->id,

        ]);
    }

    /** @test */
    public function cursos_is_boolean()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'name'  =>  'paco',
            'last_name' => 'pepe',
            'admin'     => 0,
            'ciclo_id' => $ciclo->id,
            'verified' => 1]);
        $this->actingAs($user);

        $this->post('/solicitud',[
            'user_id'    =>  $user->id,
            'empresa' => 'IES CIERVA',
            'carta' => '1',
            'cv' => '0',
            'beca' => '1',
            'cursos' => '',
            'recien_titulado' => '1'
        ])->assertSessionHasErrors('cursos');

        $this->assertDatabaseMissing('solicitudes', [
            'user_id' => $user->id,

        ]);
    }

    /** @test */
    public function delete_solicitud()
    {
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'name'  =>  'paco',
            'last_name' => 'pepe',
            'admin'     => 0,
            'ciclo_id' => $ciclo->id,
            'verified' => 1]);
        $this->actingAs($user);

        $this->post('/solicitud',[
            'user_id'    =>  $user->id,
            'empresa' => 'IES CIERVA',
            'carta' => '1',
            'cv' => '0',
            'beca' => '1',
            'cursos' => '0',
            'recien_titulado' => '1'
        ])->assertRedirect('/home');

        $this->delete('/solicitud/'.$user->solicitud->id);


        $this->assertDatabaseMissing('solicitudes', [
            'user_id' => $user->id,

        ]);
    }
}
