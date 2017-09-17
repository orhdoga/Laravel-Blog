<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\User;
        $admin->name = str_replace(' ', '-', "Admin");
        $admin->email = "info@blog.com";
        $admin->password = bcrypt("admin");
        $admin->icon = "admin-icon.jpg";
        $admin->save();
    }
}
