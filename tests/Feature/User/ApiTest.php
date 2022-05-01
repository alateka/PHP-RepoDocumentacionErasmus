<?php

namespace Tests\Feature\User;

use App\Models\Ciclo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;


class ApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    function only_registered_users_can_use_this_api(){

        $this->post('/api/getoken?name=adminAPI&email=no@registered.es&password=12345678')
        ->assertStatus(401)
        ->assertSee('Invalid login :(');
    }
}
