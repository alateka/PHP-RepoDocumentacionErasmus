<?php

namespace Tests\Feature\Admin;

use App\Models\Solicitud;
use App\Models\Ciclo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminFunctionsTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   function an_admin_can_delete_an_user(){

    $ciclo1 = Ciclo::factory()->create([
        'grado' => 'Superior',
    ]);

    $admin = User::factory()->create([
        'name'  =>  'admin',
        'last_name' => 'admin',
        'admin'     => 1,
        'ciclo_id' => $ciclo1->id,
        'verified' => 1]);

    $user1 = User::factory()->create([
        'name'  =>  'Paco',
        'last_name' => 'user1',
        'ciclo_id' => $ciclo1->id,
        'verified' => 1
        ]);

    $this->actingAs($admin);

    $this->get('/home')
    ->assertStatus(200)
    ->assertSee('Paco'); 

    $this->from('/home')
    ->delete("/home/{$user1->id}");

    
    $this->assertDatabaseMissing('users', [
        'name' => 'Paco',
    ]);

    $this->get('/home')
    ->assertStatus(200)
    ->assertDontSee('Paco'); 
 }

    /** @test */
    function an_admin_can_verify_an_user(){

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);

        $admin = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'admin'     => 1,
            'ciclo_id' => $ciclo1->id,
            'verified' => 1]);
 
        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 0
            ]);

        $this->actingAs($admin);

        $this->get('/admin/validate-users')
        ->assertStatus(200)
        ->assertSee('Paco');

        /* $this->from('/admin/validate-users')
        ->post("/admin/validate-users/{$user1->id}");

        
        $this->assertDatabaseHas('users', [
            'name' => 'Paco',
            'verified' => 1,
        ]);

        $this->get('/home')
        ->assertStatus(200)
        ->assertSee('user1'); */
     }

     /** @test */
   function an_admin_can_see_the_user_solicitud(){

    $ciclo1 = Ciclo::factory()->create([
        'grado' => 'Superior',
    ]);

    $admin = User::factory()->create([
        'name'  =>  'admin',
        'last_name' => 'admin',
        'admin'     => 1,
        'ciclo_id' => $ciclo1->id,
        'verified' => 1]);

    $user1 = User::factory()->create([
        'name'  =>  'Paco',
        'last_name' => 'user1',
        'ciclo_id' => $ciclo1->id,
        'verified' => 1
    ]);

    Solicitud::create([
        'user_id' => $user1->id,
    ]);

    $this->actingAs($admin);

    $this->get('/home')
    ->assertStatus(200)
    ->assertSee('Paco')
    ->assertSee('Ver'); 
    
    $this->get("/admin/solicitud/{$user1->id}")
        ->assertStatus(200)
        ->assertSee("Edición de solicitud");
    }


    
     /** @test */
   function an_admin_can_update_the_user_solicitud(){

    $ciclo1 = Ciclo::factory()->create([
        'grado' => 'Superior',
    ]);

    $admin = User::factory()->create([
        'name'  =>  'admin',
        'last_name' => 'admin',
        'admin'     => 1,
        'ciclo_id' => $ciclo1->id,
        'verified' => 1]);

    $user1 = User::factory()->create([
        'name'  =>  'Paco',
        'last_name' => 'user1',
        'ciclo_id' => $ciclo1->id,
        'verified' => 1
        ]);

    Solicitud::create([
        'user_id' => $user1->id,
    ]);

    $this->assertDatabaseHas('solicitudes', [
        'user_id' => $user1->id,
        'baremo' => null,
    ]);

    $this->actingAs($admin);

    $this->from("/admin/solicitud/{$user1->id}")
    ->post("/solicitud/update/{$user1->solicitud->id}",[
        'user_id' => $user1->id,
        'beca' => 0,
        'carta' => 1,
        'cv' => 1,
        'cursos' => 0,
        'empresa' => 'Ingeniero de la Cierva',
        'baremo' => 4,
    ]);

    $this->assertDatabaseHas('solicitudes', [
        'user_id' => $user1->id,
        'baremo' => 4,
    ]);
    
   }

     /** @test */
     function the_beca_value_must_be_an_integer(){

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);
    
        $admin = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'admin'     => 1,
            'ciclo_id' => $ciclo1->id,
            'verified' => 1]);
    
        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);
    
        Solicitud::create([
            'user_id' => $user1->id,
        ]);
    
        $this->assertDatabaseHas('solicitudes', [
            'user_id' => $user1->id,
            'baremo' => null,
        ]);
    
        $this->actingAs($admin);
    
        $this->from("/admin/solicitud/{$user1->id}")
        ->post("/solicitud/update/{$user1->solicitud->id}",[
            'user_id' => $user1->id,
            'beca' => "dato-falso",
            'carta' => 1,
            'cv' => 1,
            'cursos' => 0,
            'empresa' => 'Ingeniero de la Cierva',
            'baremo' => 4,
        ]);
    
        $this->assertDatabaseMissing('solicitudes', [
            'user_id' => $user1->id,
            'baremo' => 4,
        ]);
        
       }

       /** @test */
     function the_carta_value_must_be_an_integer(){

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);
    
        $admin = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'admin'     => 1,
            'ciclo_id' => $ciclo1->id,
            'verified' => 1]);
    
        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);
    
        Solicitud::create([
            'user_id' => $user1->id,
        ]);
    
        $this->assertDatabaseHas('solicitudes', [
            'user_id' => $user1->id,
            'baremo' => null,
        ]);
    
        $this->actingAs($admin);
    
        $this->from("/admin/solicitud/{$user1->id}")
        ->post("/solicitud/update/{$user1->solicitud->id}",[
            'user_id' => $user1->id,
            'beca' => 1,
            'carta' => "dato-falso",
            'cv' => 1,
            'cursos' => 0,
            'empresa' => 'Ingeniero de la Cierva',
            'baremo' => 4,
        ]);
    
        $this->assertDatabaseMissing('solicitudes', [
            'user_id' => $user1->id,
            'baremo' => 4,
        ]);
        
       }

       /** @test */
     function the_cv_value_must_be_an_integer(){

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);
    
        $admin = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'admin'     => 1,
            'ciclo_id' => $ciclo1->id,
            'verified' => 1]);
    
        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);
    
        Solicitud::create([
            'user_id' => $user1->id,
        ]);
    
        $this->assertDatabaseHas('solicitudes', [
            'user_id' => $user1->id,
            'baremo' => null,
        ]);
    
        $this->actingAs($admin);
    
        $this->from("/admin/solicitud/{$user1->id}")
        ->post("/solicitud/update/{$user1->solicitud->id}",[
            'user_id' => $user1->id,
            'beca' => 1,
            'carta' => 1,
            'cv' => "dato-falso",
            'cursos' => 0,
            'empresa' => 'Ingeniero de la Cierva',
            'baremo' => 4,
        ]);
    
        $this->assertDatabaseMissing('solicitudes', [
            'user_id' => $user1->id,
            'baremo' => 4,
        ]);
        
       }

       /** @test */
       function the_cursos_value_must_be_an_integer(){

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);
    
        $admin = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'admin'     => 1,
            'ciclo_id' => $ciclo1->id,
            'verified' => 1]);
    
        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);
    
        Solicitud::create([
            'user_id' => $user1->id,
        ]);
    
        $this->assertDatabaseHas('solicitudes', [
            'user_id' => $user1->id,
            'baremo' => null,
        ]);
    
        $this->actingAs($admin);
    
        $this->from("/admin/solicitud/{$user1->id}")
        ->post("/solicitud/update/{$user1->solicitud->id}",[
            'user_id' => $user1->id,
            'beca' => 1,
            'carta' => 1,
            'cv' => 1,
            'cursos' => "dato-falso",
            'empresa' => 'Ingeniero de la Cierva',
            'baremo' => 4,
        ]);
    
        $this->assertDatabaseMissing('solicitudes', [
            'user_id' => $user1->id,
            'baremo' => 4,
        ]);
        
       }

       /** @test */
       function an_admin_can_update_the_user_baremo(){

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);
    
        $admin = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'admin'     => 1,
            'ciclo_id' => $ciclo1->id,
            'verified' => 1]);
    
        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);
    
        Solicitud::create([
            'user_id' => $user1->id,
        ]);
    
        $this->assertDatabaseHas('solicitudes', [
            'user_id' => $user1->id,
            'baremo' => null,
        ]);
    
        $this->actingAs($admin);
    
        $this->from("/admin/solicitud/{$user1->id}")
        ->post("/solicitud/update/{$user1->solicitud->id}",[
            'user_id' => $user1->id,
            'beca' => 1,
            'carta' => 1,
            'cv' => 1,
            'conocimientos_linguisticos' => 2,
            'cursos' => 1,
            'empresa' => 'Ingeniero de la Cierva',
        ]);
    
        $this->assertDatabaseHas('solicitudes', [
            'user_id' => $user1->id,
            'baremo' => 7,
        ]);
        
       }

        /** @test */
        function the_conocimientos_linguisticos_value_must_be_an_integer(){

            $ciclo1 = Ciclo::factory()->create([
                'grado' => 'Superior',
            ]);
        
            $admin = User::factory()->create([
                'name'  =>  'admin',
                'last_name' => 'admin',
                'admin'     => 1,
                'ciclo_id' => $ciclo1->id,
                'verified' => 1]);
        
            $user1 = User::factory()->create([
                'name'  =>  'Paco',
                'last_name' => 'user1',
                'ciclo_id' => $ciclo1->id,
                'verified' => 1
                ]);
        
            Solicitud::create([
                'user_id' => $user1->id,
            ]);
        
            $this->assertDatabaseHas('solicitudes', [
                'user_id' => $user1->id,
                'baremo' => null,
            ]);
        
            $this->actingAs($admin);
        
            $this->from("/admin/solicitud/{$user1->id}")
            ->post("/solicitud/update/{$user1->solicitud->id}",[
                'user_id' => $user1->id,
                'beca' => 1,
                'carta' => 1,
                'cv' => 1,
                'cursos' => 1,
                'conocimientos_linguisticos' => "dato-falso",
                'empresa' => 'Ingeniero de la Cierva',
                'baremo' => 4,
            ]);
        
            $this->assertDatabaseMissing('solicitudes', [
                'user_id' => $user1->id,
                'beca' => 1,
                'baremo' => 4,
            ]);
            
           }

            /** @test */
       function the_expediente_academico_value_must_be_an_integer(){

        $ciclo1 = Ciclo::factory()->create([
            'grado' => 'Superior',
        ]);
    
        $admin = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'admin'     => 1,
            'ciclo_id' => $ciclo1->id,
            'verified' => 1]);
    
        $user1 = User::factory()->create([
            'name'  =>  'Paco',
            'last_name' => 'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);
    
        Solicitud::create([
            'user_id' => $user1->id,
        ]);
    
        $this->assertDatabaseHas('solicitudes', [
            'user_id' => $user1->id,
            'baremo' => null,
        ]);
    
        $this->actingAs($admin);
    
        $this->from("/admin/solicitud/{$user1->id}")
        ->post("/solicitud/update/{$user1->solicitud->id}",[
            'user_id' => $user1->id,
            'beca' => 1,
            'carta' => 1,
            'cv' => 1,
            'cursos' => 1,
            'expediente_academico' => 'dato-falso',
            'empresa' => 'Ingeniero de la Cierva',
            'baremo' => 4,
        ]);
    
        $this->assertDatabaseMissing('solicitudes', [
            'user_id' => $user1->id,
            'baremo' => 4,
        ]);
        
       }

        /** @test */
   function the_evaluacion_docente_value_must_be_an_integer(){

    $ciclo1 = Ciclo::factory()->create([
        'grado' => 'Superior',
    ]);

    $admin = User::factory()->create([
        'name'  =>  'admin',
        'last_name' => 'admin',
        'admin'     => 1,
        'ciclo_id' => $ciclo1->id,
        'verified' => 1]);

    $user1 = User::factory()->create([
        'name'  =>  'Paco',
        'last_name' => 'user1',
        'ciclo_id' => $ciclo1->id,
        'verified' => 1
        ]);

    Solicitud::create([
        'user_id' => $user1->id,
    ]);

    $this->assertDatabaseHas('solicitudes', [
        'user_id' => $user1->id,
        'baremo' => null,
    ]);

    $this->actingAs($admin);

    $this->from("/admin/solicitud/{$user1->id}")
    ->post("/solicitud/update/{$user1->solicitud->id}",[
        'user_id' => $user1->id,
        'beca' => 1,
        'carta' => 1,
        'cv' => 1,
        'cursos' => 1,
        'evaluacion_docente' => 'dato-falso',
        'empresa' => 'Ingeniero de la Cierva',
        'baremo' => 4,
    ]);

    $this->assertDatabaseMissing('solicitudes', [
        'user_id' => $user1->id,
        'baremo' => 4,
    ]);
    
   }


        /** @test */
    function the_expediente_academico_value_must_be_an_integer_between_0_and_3(){

    $ciclo1 = Ciclo::factory()->create([
        'grado' => 'Superior',
    ]);

    $admin = User::factory()->create([
        'name'  =>  'admin',
        'last_name' => 'admin',
        'admin'     => 1,
        'ciclo_id' => $ciclo1->id,
        'verified' => 1]);

    $user1 = User::factory()->create([
        'name'  =>  'Paco',
        'last_name' => 'user1',
        'ciclo_id' => $ciclo1->id,
        'verified' => 1
        ]);

    Solicitud::create([
        'user_id' => $user1->id,
    ]);

    $this->assertDatabaseHas('solicitudes', [
        'user_id' => $user1->id,
        'baremo' => null,
    ]);

    $this->actingAs($admin);

    $this->from("/admin/solicitud/{$user1->id}")
    ->post("/solicitud/update/{$user1->solicitud->id}",[
        'user_id' => $user1->id,
        'beca' => 1,
        'carta' => 1,
        'cv' => 1,
        'cursos' => 1,
        'expediente_academico' => 4,
        'empresa' => 'Ingeniero de la Cierva',
        'baremo' => 4,
    ]);

    $this->assertDatabaseMissing('solicitudes', [
        'user_id' => $user1->id,
        'expediente_academico' => 4,
    ]);

    }

        /** @test */
        function the_conocimientos_linguisticos_value_must_be_an_integer_between_0_and_3(){

            $ciclo1 = Ciclo::factory()->create([
                'grado' => 'Superior',
            ]);
        
            $admin = User::factory()->create([
                'name'  =>  'admin',
                'last_name' => 'admin',
                'admin'     => 1,
                'ciclo_id' => $ciclo1->id,
                'verified' => 1]);
        
            $user1 = User::factory()->create([
                'name'  =>  'Paco',
                'last_name' => 'user1',
                'ciclo_id' => $ciclo1->id,
                'verified' => 1
                ]);
        
            Solicitud::create([
                'user_id' => $user1->id,
            ]);
        
            $this->assertDatabaseHas('solicitudes', [
                'user_id' => $user1->id,
                'baremo' => null,
            ]);
        
            $this->actingAs($admin);
        
            $this->from("/admin/solicitud/{$user1->id}")
            ->post("/solicitud/update/{$user1->solicitud->id}",[
                'user_id' => $user1->id,
                'beca' => 1,
                'carta' => 1,
                'cv' => 1,
                'cursos' => 1,
                'conocimientos_linguisticos' => 4,
                'empresa' => 'Ingeniero de la Cierva',
                'baremo' => 4,
            ]);
        
            $this->assertDatabaseMissing('solicitudes', [
                'user_id' => $user1->id,
                'conocimientos_linguisticos' => 4,
            ]);
            
        }

        /** @test */
        function the_evaluacion_docente_value_must_be_an_integer_between_0_and_4(){

            $ciclo1 = Ciclo::factory()->create([
                'grado' => 'Superior',
            ]);
        
            $admin = User::factory()->create([
                'name'  =>  'admin',
                'last_name' => 'admin',
                'admin'     => 1,
                'ciclo_id' => $ciclo1->id,
                'verified' => 1]);
        
            $user1 = User::factory()->create([
                'name'  =>  'Paco',
                'last_name' => 'user1',
                'ciclo_id' => $ciclo1->id,
                'verified' => 1
                ]);
        
            Solicitud::create([
                'user_id' => $user1->id,
            ]);
        
            $this->assertDatabaseHas('solicitudes', [
                'user_id' => $user1->id,
                'baremo' => null,
            ]);
        
            $this->actingAs($admin);
        
            $this->from("/admin/solicitud/{$user1->id}")
            ->post("/solicitud/update/{$user1->solicitud->id}",[
                'user_id' => $user1->id,
                'beca' => 1,
                'carta' => 1,
                'cv' => 1,
                'cursos' => 1,
                'evaluacion_docente' => 5,
                'empresa' => 'Ingeniero de la Cierva',
                'baremo' => 4,
            ]);
        
            $this->assertDatabaseMissing('solicitudes', [
                'user_id' => $user1->id,
                'evaluacion_docente' => 5,
            ]);
            
           }
}
