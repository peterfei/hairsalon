<?php namespace App\Http\Controllers\Settings;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Clockwork;

class UserSettingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('settings.userCustomAttr');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$records = DB::table('custom_attr')->select('id', 'attrgroup', 'attrname', 'attrvalue', 'store')->get();
		Clockwork::debug($records);
		return response()->json($records);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$isExist = DB::table('custom_attr')->where(array(
			'attrgroup' => $request->input('attrgroup'), 
			'attrname' => $request->input('attrname')))->first();
		Clockwork::debug($isExist);
		if ($isExist) {
			$msg = array('success' => false, 'message' => '记录已存在');
		} else {
			DB::table('custom_attr')->insert(array(
			'attrgroup' => $request->input('attrgroup'), 
		    'attrname' => $request->input('attrname'),
		    'attrvalue' => $request->input('attrvalue'),
		    'store' => $request->input('store')));
		    $msg = array('success' => true, 'message' => '添加成功');
		}
		return response()->json($msg);
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
	public function update(Request $request, $id)
	{
		DB::table('custom_attr')->where('id', $id)
			->update(array(
		    'attrname' => $request->input('attrname'),
		    'attrvalue' => $request->input('attrvalue'),
		    'store' => $request->input('store')));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $ids
	 * @return Response
	 */
	public function destroy($ids)
	{
		Clockwork::debug($ids);
		DB::table('custom_attr')->whereIn('id', explode(',', $ids))->delete();
	}

}
