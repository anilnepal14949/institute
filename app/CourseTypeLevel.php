<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseTypeLevel extends Model {

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pro_course_type_levels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['course_type_id','name','description','status','created_by','updated_by'];

    /**
     * A course type level belong to course type means it is owned by a course type.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courseType(){
        return $this->belongsTo('ProIMAN\CourseType','course_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects(){
        return $this->hasMany('ProIMAN\Subject','course_type_level_id');
    }

}
