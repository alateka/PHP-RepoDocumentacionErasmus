<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeTest extends TestCase
{
    /** @test */
    function it_loads_the_main_page()
    {
        $this->get('/')
            ->assertStatus(200);
    }

    /** @test */
    function it_loads_the_faq_page()
    {
        $this->get('/faq')
            ->assertStatus(200)
            ->assertSee('Información sobre Erasmus+');
    }

    /** @test */
    function it_loads_the_listados_page()
    {
        $this->get('/listados')
            ->assertStatus(200)
            ->assertSee('Listados de años anteriores');
    }

    /** @test */
    function it_loads_the_documents_page()
    {
        $this->get('/documentos')
            ->assertStatus(200)
            ->assertSee('Listado de documentos');
    }

    /** @test */
    function it_loads_the_login_page(){
        $this->get('login')
            ->assertStatus(200);
    }

    /** @test */
    function it_loads_the_register_page(){
        $this->get('register')
            ->assertStatus(200)
            ->assertSee('Registrar');
    }

    /** @test */
    function it_loads_the_forgot_passwore_page(){
        $this->get('forgot-password')
            ->assertStatus(200)
            ->assertSee('Introduce el e-mail asociado a tu cuenta y te enviaremos un enlace para restaurar tu contraseña.');
    }
}