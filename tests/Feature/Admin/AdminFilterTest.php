<?php

namespace Tests\Feature\Admin;

use App\Models\Ciclo;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminFilterTest extends TestCase
{

    use RefreshDatabase;

     /** @test */
     function order_users_by_name_asc()
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

       $this->get('/home?camp=name&order=asc&icon=-arrow-circle-up')
           ->assertStatus(200)
           ->assertSeeInOrder([
               'user1',
               'user2',
               'user3',
           ]);

       $this->get('/home?camp=name&order=desc&icon=-arrow-circle-up')
       ->assertStatus(200)
       ->assertSeeInOrder([
           'user3',
           'user2',
           'user1',
       ]);
     }

      /** @test */
      function order_users_by_name_desc()
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
 
        $this->get('/home?camp=name&order=desc&icon=-arrow-circle-up')
        ->assertStatus(200)
        ->assertSeeInOrder([
            'user3',
            'user2',
            'user1',
        ]);
      }

    /** @test */
    function order_users_by_last_name_asc()
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
            'last_name' => 'cccc',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $user2 = User::factory()->create([
            'name'  =>  'user2',
            'last_name' => 'bbbb',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $user3 = User::factory()->create([
            'name'  =>  'user3',
            'last_name' => 'aaaaaa',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $this->actingAs($admin);

        $this->get('/home?camp=last_name&order=asc&icon=-arrow-circle-up')
        ->assertStatus(200)
        ->assertSeeInOrder([
            'user3',
            'user2',
            'user1',
        ]);
       }


       /** @test */
    function order_users_by_last_name_desc()
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
            'last_name' => 'ccccc',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $user2 = User::factory()->create([
            'name'  =>  'user2',
            'last_name' => 'aaaa',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $user3 = User::factory()->create([
            'name'  =>  'user3',
            'last_name' => 'bbbb',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $this->actingAs($admin);

        $this->get('/home?camp=last_name&order=desc&icon=-arrow-circle-up')
        ->assertStatus(200)
        ->assertSeeInOrder([
            'user1',
            'user3',
            'user2',
        ]);
    }

    /** @test */
    function order_users_by_curso_asc()
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
            'last_name' => 'ccccc',
            'year' => '2020/2021',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $user2 = User::factory()->create([
            'name'  =>  'user2',
            'last_name' => 'aaaa',
            'year' => '2021/2022',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $user3 = User::factory()->create([
            'name'  =>  'user3',
            'last_name' => 'bbbb',
            'year' => '2018/2019',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $this->actingAs($admin);

        $this->get('/home?camp=year&order=asc&icon=-arrow-circle-up')
        ->assertStatus(200)
        ->assertSeeInOrder([
            'user3',
            'user1',
            'user2',
        ]);
    }


    /** @test */
    function order_users_by_curso_desc()
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
            'last_name' => 'ccccc',
            'year' => '2020/2021',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $user2 = User::factory()->create([
            'name'  =>  'user2',
            'last_name' => 'aaaa',
            'year' => '2021/2022',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $user3 = User::factory()->create([
            'name'  =>  'user3',
            'last_name' => 'bbbb',
            'year' => '2018/2019',
            'ciclo_id' => $ciclo->id,
            'verified' => 1
            ]);

        $this->actingAs($admin);

        $this->get('/home?camp=year&order=desc&icon=-arrow-circle-up')
        ->assertStatus(200)
        ->assertSeeInOrder([
            'user2',
            'user1',
            'user3',
        ]);
    }


    /** @test */
    function filter_users_by_name()
    {

        $ciclo1 = Ciclo::factory()->create([
            'nombre' => 'DAW',
            'grado' => 'Superior',
        ]);

        $admin = User::factory()->create([
            'name'  =>  'admin',
            'admin'     => 1,
            'ciclo_id' => $ciclo1->id,
            'verified' => 1]);

        User::factory()->create([
            'name'  =>  'Pedro',
            'last_name'  =>  'Pérez',
            'email'     => 'pedroperez@mail.es',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);

        User::factory()->create([
            'name'  =>  'Luis',
            'last_name'  =>  'López',
            'email'     => 'luislopez@mail.es',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);

        $this->actingAs($admin);

        $this->get('/home?search=pedro')
        ->assertStatus(200)
        ->assertSee('Pedro')
        ->assertSee('Pérez')
        ->assertDontSee('Luis');
    }


     /** @test */
     function filter_users_by_last_name()
     {
 
         $ciclo1 = Ciclo::factory()->create([
             'nombre' => 'DAW',
             'grado' => 'Superior',
         ]);
 
         $admin = User::factory()->create([
             'name'  =>  'admin',
             'admin'     => 1,
             'ciclo_id' => $ciclo1->id,
             'verified' => 1]);
 
         User::factory()->create([
             'name'  =>  'Pedro',
             'last_name'  =>  'Pérez',
             'email'     => 'pedroperez@mail.es',
             'ciclo_id' => $ciclo1->id,
             'verified' => 1
             ]);
 
         User::factory()->create([
             'name'  =>  'Luis',
             'last_name'  =>  'López',
             'email'     => 'luislopez@mail.es',
             'ciclo_id' => $ciclo1->id,
             'verified' => 1
             ]);
 
         $this->actingAs($admin);
 
         $this->get('/home?search=perez')
         ->assertStatus(200)
         ->assertSee('Pedro')
         ->assertSee('Pérez')
         ->assertDontSee('Luis');
     }


     /** @test */
     function filter_users_by_email()
     {
 
         $ciclo1 = Ciclo::factory()->create([
             'nombre' => 'DAW',
             'grado' => 'Superior',
         ]);
 
         $admin = User::factory()->create([
             'name'  =>  'admin',
             'admin'     => 1,
             'ciclo_id' => $ciclo1->id,
             'verified' => 1]);
 
         User::factory()->create([
             'name'  =>  'Pedro',
             'last_name'  =>  'Pérez',
             'email'     => 'pedroperez@mail.es',
             'ciclo_id' => $ciclo1->id,
             'verified' => 1
             ]);
 
         User::factory()->create([
             'name'  =>  'Luis',
             'last_name'  =>  'López',
             'email'     => 'luislopez@mail.es',
             'ciclo_id' => $ciclo1->id,
             'verified' => 1
             ]);
 
         $this->actingAs($admin);
 
         $this->get('/home?search=pedroperez@mail.es')
         ->assertStatus(200)
         ->assertSee('Pedro')
         ->assertSee('Pérez')
         ->assertDontSee('Luis');
     }

    /** @test */
    function order_users_by_baremo_asc()
    {

        $ciclo1 = Ciclo::factory()->create([
            'nombre' => 'Gestión Administrativa',
            'grado' => 'Medio',
        ]);

        $admin = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'ciclo_id' => $ciclo1->id,
            'admin'     => 1,
            'verified' => 1]);

        $user1 = User::factory()->create([
            'name'  =>  'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);

        Solicitud::create([
            'user_id' => $user1->id,
            'empresa' => 'Empresa',
            'baremo' => 2,
        ]); 

        $user2 = User::factory()->create([
            'name'  =>  'user2',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);


        Solicitud::create([
            'user_id' => $user2->id,
            'carta' => 1,
            'empresa' => 'Empresa',
            'baremo' => 3,
        ]); 

        $user3 = User::factory()->create([
            'name'  =>  'user3',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);

        Solicitud::create([
            'user_id' => $user3->id,
            'carta' => 0,
            'baremo' => 0,
        ]); 

        $this->actingAs($admin);

        $this->get('/home?camp=baremo&order=asc')
        ->assertStatus(200)
        ->assertSeeInOrder([
            'user3',
            'user1',
            'user2',
        ]);
    }


    /** @test */
    function order_users_by_baremo_desc()
    {

        $ciclo1 = Ciclo::factory()->create([
            'nombre' => 'Gestión Administrativa',
            'grado' => 'Medio',
        ]);

        $admin = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'ciclo_id' => $ciclo1->id,
            'admin'     => 1,
            'verified' => 1]);

        $user1 = User::factory()->create([
            'name'  =>  'user1',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);

        Solicitud::create([
            'user_id' => $user1->id,
            'empresa' => 'Empresa',
            'baremo' => 2,
        ]); 

        $user2 = User::factory()->create([
            'name'  =>  'user2',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);


        Solicitud::create([
            'user_id' => $user2->id,
            'carta' => 1,
            'empresa' => 'Empresa',
            'baremo' => 3,
        ]); 

        $user3 = User::factory()->create([
            'name'  =>  'user3',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);

        Solicitud::create([
            'user_id' => $user3->id,
            'carta' => 0,
            'baremo' => 0,
        ]); 

        $this->actingAs($admin);

        $this->get('/home?camp=baremo&order=desc')
        ->assertStatus(200)
        ->assertSeeInOrder([
            'user2',
            'user1',
            'user3',
        ]);
    }

    /** @test */
   function filter_users_by_grado()
   {
      

       $ciclo1 = Ciclo::factory()->create([
           'grado' => 'Superior',
       ]);

       $ciclo2 = Ciclo::factory()->create([
           'grado' => 'Medio',
       ]);

       $admin = User::factory()->create([
           'name'  =>  'admin',
           'last_name' => 'admin',
           'admin'     => 1,
           'ciclo_id' => $ciclo1->id,
           'verified' => 1]);

       $user1 = User::factory()->create([
           'name'  =>  'user1',
           'last_name' => 'user1',
           'ciclo_id' => $ciclo1->id,
           'verified' => 1
           ]);

       $user2 = User::factory()->create([
           'name'  =>  'user2',
           'last_name' => 'user2',
           'ciclo_id' => $ciclo2->id,
           'verified' => 1
           ]);

       $this->actingAs($admin);

       $this->get('/home?grado=Superior')
           ->assertStatus(200)
           ->assertSee('user1')
           ->assertDontSee('user2');
   }


   

      /** @test */
      function filter_users_by_year()
      {
         
        $ciclo1 = Ciclo::factory()->create();
    
        $admin = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'admin'     => 1,
            'ciclo_id' => $ciclo1->id,
            'verified' => 1]);

        $user1 = User::factory()->create([
            'name'  =>  'user1',
            'last_name' => 'user1',
            'year'     => '2020/2021',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);

        $user2 = User::factory()->create([
            'name'  =>  'user2',
            'last_name' => 'user2',
            'year'     => '2021/2022',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);

        $this->actingAs($admin);

        $this->get('/home?year=2021%2F2022')
            ->assertStatus(200)
            ->assertSee('user2')
            ->assertDontSee('user1');

            
        $this->get('/home?year=2020%2F2021')
        ->assertStatus(200)
        ->assertSee('user1')
        ->assertDontSee('user2');

        $this->get('/home?year=2019%2F2020')
        ->assertStatus(200)
        ->assertDontSee('user1')
        ->assertDontSee('user2');
      }


      /** @test */
      function filter_users_by_solicitud()
      {
         
        $ciclo1 = Ciclo::factory()->create();
    
        $admin = User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'admin'     => 1,
            'ciclo_id' => $ciclo1->id,
            'verified' => 1]);

        $user1 = User::factory()->create([
            'name'  =>  'user1',
            'last_name' => 'user1',
            'year'     => '2020/2021',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);

        $user2 = User::factory()->create([
            'name'  =>  'user2',
            'last_name' => 'user2',
            'year'     => '2021/2022',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);

        Solicitud::create([
            'user_id' => $user1->id,
        ]);

        $this->actingAs($admin);

        $this->get('/home?solicitud=1')
            ->assertStatus(200)
            ->assertSee('user1')
            ->assertDontSee('user2');

            
        $this->get('/home?solicitud=0')
        ->assertStatus(200)
        ->assertSee('user2')
        ->assertDontSee('user1');
      }


       /** @test */
       function filter_users_by_dynamic_search()
       {
          
         $ciclo1 = Ciclo::factory()->create();
     
         $admin = User::factory()->create([
             'name'  =>  'admin',
             'last_name' => 'admin',
             'admin'     => 1,
             'ciclo_id' => $ciclo1->id,
             'verified' => 1]);
 
         $user1 = User::factory()->create([
             'name'  =>  'Pepe',
             'last_name' => 'Pérez',
             'year'     => '2020/2021',
             'ciclo_id' => $ciclo1->id,
             'verified' => 1
             ]);
 
         $user2 = User::factory()->create([
             'name'  =>  'Carlos',
             'last_name' => 'Cano',
             'year'     => '2021/2022',
             'ciclo_id' => $ciclo1->id,
             'verified' => 1
             ]);
 
         $this->actingAs($admin);
 
         $this->get('/home?search=pepe')
             ->assertStatus(200)
             ->assertSee('Pepe')
             ->assertDontSee('Carlos');
 
             
         $this->get('/home?search=carlos')
         ->assertStatus(200)
         ->assertSee('Carlos')
         ->assertDontSee('Pepe');
       }

        /** @test */
    function filter_users_by_some_filters()
    {

        $ciclo1 = Ciclo::factory()->create([
            'nombre' => 'DAW',
            'grado' => 'Superior',
        ]);

        $ciclo2 = Ciclo::factory()->create([
            'nombre' => 'Radioterapia',
            'grado' => 'Medio',
        ]);

        $admin = User::factory()->create([
            'name'  =>  'admin',
            'admin'     => 1,
            'ciclo_id' => $ciclo1->id,
            'verified' => 1]);

        User::factory()->create([
            'name'  =>  'Pedro',
            'last_name'  =>  'Pérez',
            'email'     => 'pedroperez@mail.es',
            'ciclo_id' => $ciclo1->id,
            'verified' => 1
            ]);

        User::factory()->create([
            'name'  =>  'Luis',
            'last_name'  =>  'López',
            'email'     => 'luislopez@mail.es',
            'ciclo_id' => $ciclo2->id,
            'verified' => 1
            ]);

        $this->actingAs($admin);

        $this->get('/home?search=pedro&grado=Superior')
        ->assertStatus(200)
        ->assertSee('Pedro')
        ->assertSee('Pérez')
        ->assertDontSee('Luis');
    }

          /** @test */
          function filter_users_by_name_in_verify_users_page()
          {
      
              $ciclo1 = Ciclo::factory()->create([
                  'nombre' => 'DAW',
                  'grado' => 'Superior',
              ]);
      
              $ciclo2 = Ciclo::factory()->create([
                  'nombre' => 'Radioterapia',
                  'grado' => 'Medio',
              ]);
      
              $admin = User::factory()->create([
                  'name'  =>  'admin',
                  'admin'     => 1,
                  'ciclo_id' => $ciclo1->id,
                  'verified' => 1]);
      
              User::factory()->create([
                  'name'  =>  'Pedro',
                  'last_name'  =>  'Pérez',
                  'email'     => 'pedroperez@mail.es',
                  'ciclo_id' => $ciclo1->id,
                  'verified' => 0
                  ]);
      
              User::factory()->create([
                  'name'  =>  'Luis',
                  'last_name'  =>  'López',
                  'email'     => 'luislopez@mail.es',
                  'ciclo_id' => $ciclo2->id,
                  'verified' => 0
                  ]);
      
              $this->actingAs($admin);
      
              $this->get('/admin/validate-users?search=pedro')
              ->assertStatus(200)
              ->assertSee('Pedro')
              ->assertSee('Pérez')
              ->assertDontSee('Luis');
          }

          /** @test */
          function a_verified_user_doesnt_show_in_verify_users_page()
          {
      
              $ciclo1 = Ciclo::factory()->create([
                  'nombre' => 'DAW',
                  'grado' => 'Superior',
              ]);
      
              $ciclo2 = Ciclo::factory()->create([
                  'nombre' => 'Radioterapia',
                  'grado' => 'Medio',
              ]);
      
              $admin = User::factory()->create([
                  'name'  =>  'admin',
                  'admin'     => 1,
                  'ciclo_id' => $ciclo1->id,
                  'verified' => 1]);
      
              User::factory()->create([
                  'name'  =>  'Pedro',
                  'last_name'  =>  'Pérez',
                  'email'     => 'pedroperez@mail.es',
                  'ciclo_id' => $ciclo1->id,
                  'verified' => 0
                  ]);
      
              User::factory()->create([
                  'name'  =>  'Luis',
                  'last_name'  =>  'López',
                  'email'     => 'luislopez@mail.es',
                  'ciclo_id' => $ciclo2->id,
                  'verified' => 1
                  ]);
      
              $this->actingAs($admin);
      
              $this->get('/admin/validate-users')
              ->assertStatus(200)
              ->assertSee('Pedro')
              ->assertSee('Pérez')
              ->assertDontSee('Luis');
          }
}
