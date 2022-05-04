<?php

namespace Tests\Feature\User;

use App\Models\Ciclo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    function create_user(){
        $ciclo = Ciclo::factory()->create();

        User::factory()->create([
            'name'  =>  'paco',
            'last_name' => 'pepe',
            'admin'     => 0,
            'ciclo_id' => $ciclo->id,
            'verified' => 0]);

        $this->assertDatabaseHas('users',[
            'name'  =>  'paco',
            'last_name' => 'pepe',
            'admin'     => 0,
            'ciclo_id' => $ciclo->id,
            'verified' => 0]);
    }

    /** @test */
    function verified_user_do_not_redirects_home(){
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'name'  =>  'paco',
            'last_name' => 'pepe',
            'admin'     => 0,
            'ciclo_id' => $ciclo->id,
            'verified' => 0]);

        $this->actingAs($user);

        $this->get('/home')
            ->assertStatus(302)
            ->assertRedirect('/not-verify');

    }

    /** @test */
    function verified_user_redirects_home(){
        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'name'  =>  'paco',
            'last_name' => 'pepe',
            'admin'     => 0,
            'ciclo_id' => $ciclo->id,
            'verified' => 1]);

        $this->actingAs($user);

        $this->get('/home')
            ->assertStatus(200)
            ->assertSee('Documentación y datos del usuario');
    }
}
