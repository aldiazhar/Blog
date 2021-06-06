<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$writer = new Role();
        $writer->name = 'Writer';
        $writer->slug = 'writer';
        $writer->save();

        $publisher = new Role();
        $publisher->name = 'Publisher';
        $publisher->slug = 'publisher';
        $publisher->save();

        $superAdmin = new Role();
        $superAdmin->name = 'Super Admin';
        $superAdmin->slug = 'super-admin';
        $superAdmin->save();

        $tamu = new Role();
        $tamu->name = 'Tamu';
        $tamu->slug = 'tamu';
        $tamu->save();
    }
}
