<?php

namespace Tests\Feature\User;

use App\Models\Ciclo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRedirectsTest extends TestCase
{

    use RefreshDatabase;
 
    /** @test */
    public function a_non_verified_user_cannot_access_to_his_control_panel()
    {

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);

        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 0
        ]);

        $this->actingAs($user1);

        $this->get('/home')
            ->assertStatus(302)
            ->assertRedirect('/not-verify');
    }

    /** @test */
    public function a_non_verified_user_cannot_access_to_the_solicitud_panel()
    {

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);

        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 0
        ]);

        $this->actingAs($user1);

        $this->get('/solicitud')
            ->assertStatus(302)
            ->assertRedirect('/not-verify');
    }

    /** @test */
    public function an_user_cannot_access_to_the_admin_validate_users_zone()
    {

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);

        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
        ]);

        $this->actingAs($user1);

        $this->get('/admin/validate-users')
            ->assertStatus(302)
            ->assertRedirect('/');
    }

    /** @test */
    public function an_user_cannot_access_to_the_admin_listados_zone()
    {

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);

        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
        ]);

        $this->actingAs($user1);

        $this->get('/admin/listados')
            ->assertStatus(302)
            ->assertRedirect('/');
    }

    /** @test */
    public function an_user_cannot_access_to_the_admin_generate_listados_zone()
    {

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);

        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
        ]);

        $this->actingAs($user1);

        $this->get('/admin/listados/generate')
            ->assertStatus(302)
            ->assertRedirect('/');
    }

    /** @test */
    public function an_user_cannot_access_to_the_admin_solicitud_review_zone()
    {

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);

        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
        ]);

        $this->actingAs($user1);

        $this->get("/admin/solicitud/$user1->id")
            ->assertStatus(302)
            ->assertRedirect('/');
    }
}
