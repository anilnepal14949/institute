<?php namespace ProIMAN\Http\Requests\setting;

use ProIMAN\Http\Requests\Request;

class CreateCourseTypeLevelRequest extends Request {

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
			'course_type_id'=>'required|numeric|min:1'
		];
	}

}
