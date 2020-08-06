<?php namespace ProIMAN\Http\Requests\setting;

use ProIMAN\Http\Requests\Request;

class CreateTeacherRequest extends Request {

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
			'address'=>'required',
			'email'=>'sometimes|email',
			'gender'=>'required',
			'image'=>'sometimes|mimes:jpg,png,bmp,jpeg'
		];
	}

}
