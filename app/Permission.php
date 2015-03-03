<?php namespace App;

use Zizaco\Entrust\EntrustPermission;
class Permission extends EntrustPermission {

	//
	protected $table = 'permissions';

    public function parent() {

        return $this->hasOne('App\Permission', 'id', 'parent_id');

    }

    public function children() {

        return $this->hasMany('App\Permission', 'parent_id', 'id');

    }  

    public static function tree() {
    	// $querys = static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '=', 0);
    	// var_dump($querys->toSql());
        return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '=', 0)->get();


    }
}