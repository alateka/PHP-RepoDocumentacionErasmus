<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ciclo;

class CicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Informatica

        Ciclo::factory()->create([
            'nombre'  =>  'Desarrollo de Aplicaciones Web',
            'grado'  =>  'Superior',
            'rama'   => 'Informática']);

        Ciclo::factory()->create([
            'nombre'  =>  'Desarrollo de Aplicaciones Multiplataforma',
            'grado'  =>  'Superior',
            'rama'   => 'Informática']);

        Ciclo::factory()->create([
            'nombre'  =>  'Administración de Sistemas Informáticos y Redes',
            'grado'  =>  'Superior',
            'rama'   => 'Informática']);

        Ciclo::factory()->create([
            'nombre'  =>  'Sistemas Microinformáticos y Redes',
            'grado'  =>  'Medio',
            'rama'   => 'Informática']);


        //Electronica
        Ciclo::factory()->create([
            'nombre'  =>  'Instalaciones de Telecomunicaciones',
            'grado'  =>  'Medio',
            'rama'   => 'Electrónica']);

        Ciclo::factory()->create([
            'nombre'  =>  'Sistemas de Telecomunicación e Informáticos',
            'grado'  =>  'Superior',
            'rama'   => 'Electrónica']);


        //Administracion

        Ciclo::factory()->create([
            'nombre'  =>  'Gestión Administrativa',
            'grado'  =>  'Medio',
            'rama'   => 'Administración']);

        Ciclo::factory()->create([
            'nombre'  =>  'Administración y Finanzas',
            'grado'  =>  'Superior',
            'rama'   => 'Administración']);

        //Sanidad


        Ciclo::factory()->create([
            'nombre'  =>  'Cuidados Auxiliares de Enfermería',
            'grado'  =>  'Medio',
            'rama'   => 'Sanidad']);

        Ciclo::factory()->create([
            'nombre'  =>  'Radioterapia',
            'grado'  =>  'Superior',
            'rama'   => 'Sanidad']);

        Ciclo::factory()->create([
            'nombre'  =>  'Documentación Sanitaria',
            'grado'  =>  'Superior',
            'rama'   => 'Sanidad']);

        Ciclo::factory()->create([
            'nombre'  =>  'Imagen para el Diagnóstico',
            'grado'  =>  'Superior',
            'rama'   => 'Sanidad']);

        Ciclo::factory()->create([
            'nombre'  =>  'Prótesis Dental',
            'grado'  =>  'Superior',
            'rama'   => 'Sanidad']);
    }
}
