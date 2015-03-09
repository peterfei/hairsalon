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
		DB::table('custom_attr')->insert(array(
			'attrgroup' => $request->input('attrgroup'), 
		    'attrname' => $request->input('attrname'),
		    'attrvalue' => $request->input('attrvalue'),
		    'store' => $request->input('store')));
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
		Clockwork::debug($id);
		DB::table('custom_attr')->where('id', $id)->delete();
	}

}
