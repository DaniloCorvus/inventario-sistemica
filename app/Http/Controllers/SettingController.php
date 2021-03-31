<?php

namespace App\Http\Controllers;

use App\Role;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class SettingController extends Controller
{
    // add multiple users to service
    public function addmultiple()
    {

        $services = Service::get(['user_id', 'id', 'fecha_inicio']);

        foreach ($services as $service) {
            $service->users()->attach($service->user_id, ['percent' => 100, 'main' => true]);
        }
    }

    // add seeders
    public  function addSeeder()
    {
        Config::set('database.connections.main.database', 'master');
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrador';
        $role->save();
        $role = new Role();
        $role->name = 'user';
        $role->description = 'User';
        $role->save();

        $role = new Role();
        $role->name = 'cliente';
        $role->description = 'Cliente';
        $role->save();

        $role = new Role();
        $role->name = 'tecnico';
        $role->description = 'Tecnico';
        $role->save();
    }

    public function clearcache()
    {
        Cache::flush();
        return 'Done';
    }
}
