<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\Role;
use \App\Permission;
class RolesAndPermissionsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		 DB::table('roles')->delete();
         DB::table('permissions')->delete();

        $customer = new Role();
        $customer->name = 'Customer';
        $customer->save();

        $admin = new Role();
        $admin->name = 'Admin';
        $admin->save();

        $sales = new Role();
        $sales->name = 'Sales';
        $sales->save();

        $marketing = new Role();
        $marketing->name = 'Marketing';
        $marketing->save();

        $create_user = new Permission();
        $create_user->name = 'can_create_user';
        $create_user->display_name = 'Can Create Users';
        $create_user->save();
    /* ... */
        $admin->attachPermission($create_user);
    /* ... */
        $user1 = App\User::find(1);

        $user1->attachRole($admin);
        // var_dump($user1->hasRole('Admin'));
	}

}
