<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //membuat role admin
	$adminRole = new Role();
	$adminRole->name = "admin";
	$adminRole->display_name = "administrator";
	$adminRole->save();

        //membuat role front office
	$foRole = new Role();
	$foRole->name = "frontoffice";
	$foRole->display_name = "Front Office";
	$foRole->save();

        //membuat role karyawan
	$gRole = new Role();
	$gRole->name = "guest";
	$gRole->display_name = "guest";
	$gRole->save();


	//sample admin
	$admin = new User();
	$admin->username = "admin";
	$admin->name = "admin";
	$admin->email = "admin@op.com";
	$admin->password = bcrypt('rahasia');
	$admin->save();
	$admin->attachRole($adminRole);

	//sample front office
	$admin = new User();
	$admin->username = "siti";
	$admin->name = "siti";
	$admin->email = "siti@op.com";
	$admin->password = bcrypt('rahasia');
	$admin->save();
	$admin->attachRole($foRole);

	//sample guest
	$admin = new User();
	$admin->username = "rafa";
	$admin->name = "rafa";
	$admin->email = "rafa@op.com";
	$admin->password = bcrypt('rahasia');
	$admin->save();
	$admin->attachRole($gRole);

	$admin = new User();
	$admin->username = "rikad";
	$admin->name = "rikad";
	$admin->email = "rikad@op.com";
	$admin->password = bcrypt('rahasia');
	$admin->save();
	$admin->attachRole($gRole);

    }
}
