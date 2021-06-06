<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('slug','super-admin')->first();
        $writer = Role::where('slug','writer')->first();
        $publisher = Role::where('slug', 'publisher')->first();

        $writerPermission = Permission::where('slug','menulis-artikel')->orWhere('slug','mengedit-artikel')->get();
        $publisherPermission = Permission::where('slug','mereview-artikel')->orWhere('slug','menerbitkan-artikel')->get();
        $adminPermission = Permission::get();

        $user1 = new User();
        $user1->name = 'Gold Roger';
        $user1->email = 'gold@roger.com';
        $user1->password = bcrypt('secret');
        $user1->save();
        $user1->roles()->attach($admin);
        $user1->permissions()->attach($adminPermission);

        $user2 = new User();
        $user2->name = 'Jhon Deo';
        $user2->email = 'jhon@deo.com';
        $user2->password = bcrypt('secret');
        $user2->save();
        $user2->roles()->attach($writer);
        $user2->permissions()->attach($writerPermission);


        $user3 = new User();
        $user3->name = 'Mike Thomas';
        $user3->email = 'mike@thomas.com';
        $user3->password = bcrypt('secret');
        $user3->save();
        $user3->roles()->attach($publisher);
        $user3->permissions()->attach($publisherPermission);
    }
}
