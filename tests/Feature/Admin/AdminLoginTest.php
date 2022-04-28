<?php

namespace Tests\Feature\Admin;

use App\Models\Ciclo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;
    
     /** @test */
     function an_admin_is_redirected_to_admin_control_panel_when_logs_in()
     {

      $ciclo = Ciclo::factory()->create();

        $password = Hash::make(12345678);

        $user = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'email' => 'admin@mail.es',
            'password'  =>  $password,
            'year' => '2021/2022',
            'admin'     => 1,
            'ciclo_id' => $ciclo->id,
            'verified' => 1]);

        $this->assertDatabaseHas('users', [
            'name' => 'admin',
            'email' => 'admin@mail.es',
            'password' => $user->password,
        ]);
  
        $this->actingAs($user);

        $this->get('/home')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios');
     }


     /** @test */
     function an_admin_cannot_access_into_the_admin_panel_without_login()
     {

        $ciclo = Ciclo::factory()->create();

        $user = User::factory()->create([
            'admin'     => 1,
            'ciclo_id' => $ciclo->id,
            'verified' => 1]);

        $this->get('/home')
            ->assertStatus(302);
     }

      /** @test */
      function it_loads_the_users_list()
      {
 
        $ciclo = Ciclo::factory()->create();
 
        $admin = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'admin'     => 1,
            'ciclo_id' => $ciclo->id,
            'verified' => 1]);
 
        $user1 = User::factory()->create([
            'name'  =>  'user1',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $user2 = User::factory()->create([
            'name'  =>  'user2',
            'last_name' => 'user2',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $user3 = User::factory()->create([
            'name'  =>  'user3',
            'last_name' => 'user3',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $this->actingAs($admin);

        $this->get('/home')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('user1')
            ->assertSee('user2')
            ->assertSee('user3');
      }
}
