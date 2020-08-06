<?php namespace ProIMAN\Http\Requests\setting;

use ProIMAN\Http\Requests\Request;

class CreateOurCourseRequest extends Request {

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
			'subject_id'=>'required|numeric|min:1',
			'room_id'=>'required|numeric|min:1',
			'teacher_id'=>'required|numeric|min:1',
			'status_id'=>'required|numeric|min:1',
			'capacity'=>'required|numeric|min:1',
			'course_fee'=>'required|numeric|min:0',
			'form_fee'=>'sometimes|numeric|min:0',
		];
	}

}
