<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\Role;
use \App\Permission;
class PermissionsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		 
            // $permission1 = new Permission();
            // $permission1->name='can_delete1_member';
            // $permission1->parent_id=19;
            // $permission1->auth_action='';
            // $permission1->auth_func='';
            // $permission1->url='';
            // $permission1->save();
            // $permission2 = new Permission();
            // $permission2->name='can_delete1_detail';
            // $permission2->parent_id=19;
            // $permission2->auth_action='';
            // $permission2->auth_func='';
            // $permission2->url='';
            // $permission2->save();
            var_dump(Permission::tree());
            // var_dump($user1->hasRole('Admin'));
	}

}
