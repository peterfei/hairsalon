<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class MemberRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'=>'required',
			'phone'=>'required|numeric|regex:/[0-9]{10,11}/',
			'cid'=>'required',
			'expiration'=>'required'

		];
	}

	// public function messages() {
	// 	return [
	// 	    'required' => ucwords(':attribute') . ' 必填.'
	// 	];
	// }

}
