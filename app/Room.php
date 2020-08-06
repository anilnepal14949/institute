<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;


class Room extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pro_room';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'capacity', 'status','created_by','updated_by','number','image'];


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ourCourse(){
		return $this->hasMany('ProIMAN\OurCourse','room_id');
	}
}
