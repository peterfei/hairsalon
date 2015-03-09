<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use App\Http\Requests\MemberRequest;
class MemberController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			# code...
			$map = array();
			if (!empty($request->input('name'))) {
				# code...
				$map['name'] = $request->input('name');
			}
			
			// $map['phone']= $request->input('phone');
			$html = view('member._index',['data'=>Member::where($map)->orderBy('id','desc')->paginate(15)])->render();
			return response()->json(array($html));
		}
		return view('member.index',['data'=>Member::orderBy('id','desc')->paginate(15)]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('member.member_new');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request,MemberRequest $member_request)
	{
		// Debugbar::addMessage('member obj',$member);
		$member = new Member();
		$member->name = $request->input('name');
		$member->phone = $request->input('phone');
		$member->gender = $request->input('gender');
		$member->cid = $request->input('cid');
		$member->level = $request->input('level');
		$member->expiration = $request->input('expiration');
		$member->status = $request->input('status');
		$member->integral = $request->input('integral');
		// Debugbar::addMessage('member obj',$member);
		if ($member->save()) {
			# code...
			$html = view('member._index',['data'=>Member::orderBy('id','desc')->paginate(15)])->render();
			return response()->json(['success'=>'success','data'=>$html]);
		}else{
			return response()->json('fail');
		}

		
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

}
