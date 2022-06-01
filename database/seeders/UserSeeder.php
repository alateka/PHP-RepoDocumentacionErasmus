<?php

namespace Database\Seeders;

use App\Models\Idioma;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    private $idiomas;
    private $niveles = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
    private $years = ['2018/2019', '2019/2020', '2020/2021', '2021/2022'];
    

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->fetchRelations();
        $this->createAdmin();
       
        User::factory()->create([
            'name'  =>  'pepe',
            'last_name' => 'perez',
            'email' => 'pepe@mail.es',
            'password'  =>  Hash::make('12345678'),
            'year' => '2021/2022',
            'admin'     => 0,
            'verified' => 1,]);

        foreach (range(1, 300) as $i){
            $this->createRandomUserWithSolicitud();
        }

        foreach (range(1, 100) as $i){
            $this->createVerifiedUserWithoutSolicitud();
        }
    }

    public function createAdmin(){

        User::factory()->create([
            'name'  =>  'admin',
            'last_name' => 'admin',
            'email' => 'admin@mail.es',
            'password'  =>  Hash::make('12345678'),
            'year' => '2021/2022',
            'admin'     => 1,
            'verified' => 1,]);

    }

    public function fetchRelations(){

        $this->idiomas = Idioma::all();
    }

    public function createRandomUserWithSolicitud(){

        $user = User::factory()->create([
            'year' => $this->years[rand(0,3)],
            'verified' => rand(0,1),
        ]);

        if($user->verified){
            $user->solicitud()->create([
                'user_id' => $user->id,
                'empresa' => 'IES Ingeniero de la Cierva',
                'beca' => rand(0,1),
                'carta' => rand(0,1),
                'cv' => rand(0,1),
                'cursos' => rand(0,1),
                'recien_titulado' => rand(0,1),
            ]);
        }

        

        if($user->solicitud){

            $baremo = 0;
            if($user->solicitud->empresa){
                $baremo += 2;
            }
    
            if($user->solicitud->carta){
                $baremo ++;
            }
    
            if($user->solicitud->cv){
                $baremo ++;
            }
    
            if($user->solicitud->cursos){
                $baremo ++;
            }
    
            $user->solicitud()->update([
                'baremo' => $baremo
            ]);

        }
    }

    public function createVerifiedUserWithoutSolicitud(){

        User::factory()->create([
            'year' => $this->years[rand(0,3)],
            'verified' => 1,
        ]);

    }
}
