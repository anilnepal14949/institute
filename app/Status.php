<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;


class Status extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pro_status';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'status','created_by','updated_by'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ourCourse(){
		return $this->hasMany('ProIMAN\OurCourse','status_id');
	}
}
