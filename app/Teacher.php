<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model {

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pro_teachers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','status','created_by','updated_by','extra_qualification','associated_in','qualification','userType'];


    /**
     * A teacher belong to only one user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userDetail(){
        return $this->belongsTo('ProIMAN\UserDetail','user_id');
    }

    /**
     * A teacher can have many our courses.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function ourCourses(){
        return $this->morphMany('ProIMAN\OurCourse','morphOurCourse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ourCourse(){
        return $this->hasMany('ProIMAN\OurCourse','teacher_id');
    }
}
