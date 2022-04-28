<?php

namespace App\Providers;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {

        //Paginator::useBootstrap();

        $events->listen(BuildingMenu::class, function(BuildingMenu $event){
            $event->menu->add('ADMINISTRACIÓN');
            $event->menu->add([
                'text' => 'Validar usuarios',
                'url'  => '/admin/validate-users',
                'label' => count(User::where('verified', 0)->get()),
                'icon' => 'fas fa-fw fa-user-check',
                'label_color' => 'danger'

            ],
            [
                'text' => 'Generar listados',
                'url'  => '/admin/listados',
                'icon' => 'fas fa-fw fa-list',
            ]);
        });
    }
}
