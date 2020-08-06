<?php namespace ProIMAN\Http\Requests\setting;

use ProIMAN\Http\Requests\Request;

class CreateRoomRequest extends Request {

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
			'number'=>'required',
			'capacity'=>'sometimes|numeric',
			'image'=>'sometimes|mimes:jpeg,jpg,png,bmp'
		];
	}

	/**
	 * Change Input data
	 */
	/*public function all(){
		$input = $this->all();
		isset($input['status'])?$input['status'] = '0':$input['status']='1';
		$this->replace($input);
		return $this->all();
	}*/

}
