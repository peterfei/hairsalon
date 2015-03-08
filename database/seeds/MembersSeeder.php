<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\Member;
// use \App\Permission;
class MembersSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		 
            
            for ($i=0; $i < 50; $i++) { 
                  # code...
                  $member = new Member();
                  $member->name = 'peter';
                  $member->gender = '男';
                  $member->phone='18092058670';
                  $member->cid = '1001';
                  $member->level = 'first';
                  $member->status = 1;
                  $member->expiration = '2015-12-30 00:00:00';
                  $member->integral =0;
                  $member->save();
            }
            
           
            // var_dump($user1->hasRole('Admin'));
	}

}
