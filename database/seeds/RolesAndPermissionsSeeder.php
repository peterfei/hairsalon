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
        $customer->display_name = '店员';
        $customer->save();

        $admin = new Role();
        $admin->name = 'Admin';
        $admin->display_name = '管理员';
        $admin->save();

        $sales = new Role();
        $sales->name = 'Sales';
        $sales->display_name = '销售';
        $sales->save();

        $marketing = new Role();
        $marketing->name = 'Marketing';
        $marketing->display_name = '总监';
        $marketing->save();

        $create_user = new Permission();
        $create_user->name = 'can_create_user';
        $create_user->display_name = '新建用户';
        $create_user->save();

        $edit_user = new Permission();
        $edit_user->name = 'can_edit_user';
        $edit_user->display_name = '编辑用户';
        $edit_user->save();
    /* ... */
        $admin->attachPermission($create_user);
        $admin->attachPermission($edit_user);
    /* ... */
        $user1 = App\User::find(1);

        $user1->attachRole($admin);
        // var_dump($user1->hasRole('Admin'));
	}

}
