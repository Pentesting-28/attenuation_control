<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ///////////////////////////
        ////////    Root   ///////
        /////////////////////////
        $user_root = User::where('email',"super_admin@hes.com")->first();

        if($user_root)
        {
            $user_root->delete();
        }

        $user_root = User::create([
        	"name"  => "super admin",
            "last_name" => "super administrador",
        	"email" => "super_admin@hes.com",
        	"password" => bcrypt("secret")
        ]);

        ///////////////////////////
        ///////     Admin    /////
        /////////////////////////
        $user_admin = User::where('email',"admin@hes.com")->first();

        if($user_admin)
        {
            $user_admin->delete();
        }
        $user_admin = User::create([
            "name"  => "admin",
            "last_name" => "administrador",
            "email" => "admin@hes.com",
            "password" => bcrypt("secret")
        ]);
    }
}
