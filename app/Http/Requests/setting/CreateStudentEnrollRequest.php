<?php namespace ProIMAN\Http\Requests\setting;

use ProIMAN\Http\Requests\Request;

class CreateStudentEnrollRequest extends Request {

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
			'our_course_id'=>'required|numeric|min:1',
			'student_id'=>'required|numeric|min:1',
		];
	}

}
