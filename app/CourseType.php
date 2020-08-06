<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseType extends Model {

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pro_course_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','status','created_by','updated_by'];

    /**
     * A course type can have many course type level.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function CourseTypeLevel(){
        return $this->hasMany('ProIMAN\CourseTypeLevel','course_type_id');
    }

    /**
     * A course type can have many subjects through course type level.
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function subject(){
        return $this->hasManyThrough('ProIMAN\Subject','ProIMAN\CourseTypeLevel','course_type_id','course_type_level_id');
    }
}
