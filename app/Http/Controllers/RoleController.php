<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
class RoleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//角色列表
		$roles = Role::all();
		return view('role.index',['roles'=>$roles]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	
	
	/*
	 *弹窗
	 */
	public function modal(Request $request)
	{
		# code...
		// $roles = Role::all();
		// $response = array('status' => 'success', 'msg' => 'You got book details successfully');
		$permissons = Permission::tree();
		// dump($permissons->toArray());
		// $data = '[{name: "父节点1", children: [{name: "子节点1"},{name: "子节点2"}]}]';
		// dump(array_fetch(Role::find(58)->perms->toArray(),'id'));
		// dump();
		$id = $request->route("id");
		return view('role.role_modal',['data'=>$permissons->toArray(),'role'=> Role::find($id),'modal_id'=>$id]);
		
	}
	/*
	 *角色赋值给权限
	 */
	public function role_permissions(Request $request)
	{
		# code...
		// var_dump($request->input("nodes"));
		$role = Role::find($request->input("modal_id"));
		// dump($role->perms->toArray());
		$nodes =array_filter(explode(',', $request->input("nodes"))) ;
		$cancelnodes = $request->input("cancelnodes") ;
		

		// $role->detachPermission($role->perms()->first());
		
		// dump($cancelnodes);
		if (count($cancelnodes)>0) {
			foreach ($cancelnodes as $cal) {
			# code...
			$cal  = Permission::where('id','=',(int)$cal)->get()->first();
			// var_dump($permission);
			$role->detachPermission($cal);
			// $role->attachPermission($permission);
			}
		}
		if (count($nodes)>0) {
			foreach ($nodes as $node) {
			# code...
				$permission  = Permission::where('id','=',(int)$node)->get()->first();
				// var_dump($permission);
				$role->detachPermission($permission);
				$role->attachPermission($permission);
			}
		}
		
		return response() ->json('success',200);
	}
}
