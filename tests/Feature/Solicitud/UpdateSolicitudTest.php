<?php

namespace Tests\Feature\Solicitud;

use App\Models\Ciclo;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UpdateSolicitudTest extends TestCase
{
    Use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */



    /** @test */
    public function update_solicitud()
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
            'empresa' => 'PacoPepe',
            'carta' => '1',
            'cv' => '0',
            'beca' => '1',
            'cursos' => '0',
        ]);

        $this->post('/solicitud/update',[
            'solicitud_id'    =>  $user->solicitud->id,
            'user_id'    =>  $user->id,
            'empresa' => 'IES CIERVA',
            'carta' => '1',
            'cv' => '0',
            'beca' => '1',
            'cursos' => '0',
        ]);

        $this->assertDatabaseHas('solicitudes', [
            'user_id' => $user->id,
            'empresa' => 'IES CIERVA',
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
            'carta' => '1',
            'cv' => '0',
            'beca' => '1',
            'cursos' => '0',
        ]);

        $this->post('/solicitud/update',[
            'solicitud_id'    =>  $user->solicitud->id,
            'user_id'    =>  $user->id,
            'empresa' => 'IES CIERVA',
            'carta' => '2',
            'cv' => '0',
            'beca' => '1',
            'cursos' => '0',
        ]);

        $this->assertDatabaseMissing('solicitudes', [
            'carta' => '2',

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
            'cv' => '0',
            'beca' => '1',
            'cursos' => '0',
        ]);

        $this->post('/solicitud/update',[
            'solicitud_id'    =>  $user->solicitud->id,
            'user_id'    =>  $user->id,
            'empresa' => 'IES CIERVA',
            'carta' => '1',
            'cv' => '2',
            'beca' => '1',
            'cursos' => '0',
        ]);

        $this->assertDatabaseMissing('solicitudes', [
            'cv' => '2',

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
            'beca' => '1',
            'cursos' => '0',
        ]);

        $this->post('/solicitud/update',[
            'solicitud_id'    =>  $user->solicitud->id,
            'user_id'    =>  $user->id,
            'empresa' => 'IES CIERVA',
            'carta' => '1',
            'cv' => '0',
            'beca' => '2',
            'cursos' => '0',
        ]);

        $this->assertDatabaseMissing('solicitudes', [
            'beca' => '2',

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
            'cursos' => '0',
        ]);

        $this->post('/solicitud/update',[
            'solicitud_id'    =>  $user->solicitud->id,
            'user_id'    =>  $user->id,
            'empresa' => 'IES CIERVA',
            'carta' => '1',
            'cv' => '0',
            'beca' => '1',
            'cursos' => '2',
        ]);

        $this->assertDatabaseMissing('solicitudes', [
            'cursos' => '2',

        ]);
    }
}
