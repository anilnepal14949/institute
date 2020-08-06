<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model {

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pro_subjects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['course_type_level_id','name','description','status','created_by','updated_by'];

    /**
     * A Subject belongs to only one Course Type Level.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courseTypeLevel(){
        return $this->belongsTo('ProIMAN\CourseTypeLevel','course_type_level_id');
    }

    /**
     * A subject can have many inquiries.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inquiries(){
        return $this->hasMany('ProIMAN\Inquiry','subject_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ourCourse(){
        return $this->hasMany('ProIMAN\OurCourse','subject_id');
    }
}
