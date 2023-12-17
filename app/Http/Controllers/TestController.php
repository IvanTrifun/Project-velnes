<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TestController extends Controller
{
    public function test()
    {

        $companies = Company::all();

        $usersCollection = new Collection;
        $rolesCollection = new Collection;
        $servicesCollection = new Collection;

        foreach ($companies as $company) {
            $users = $company->users;
            $services = $company->services;
            foreach ($users as $user)
            {
                $usersCollection->push($user);
                $roles = $user->roles;
                foreach ($roles as $role){
                    $rolesCollection->push($role);
                }
            }
            foreach ($services as $service) {
                $servicesCollection->push($service);
            }

        }

        return view('test', compact('companies', 'usersCollection', 'rolesCollection', 'servicesCollection'));
    }

}
