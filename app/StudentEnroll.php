<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentEnroll extends Model {

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pro_student_enroll';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id','status','created_by','updated_by','our_course_id','referer_id','enroll_date','admin_note','account_note'];

    /**
     * A student enrolls with only one course at a time.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ourCourse(){
        return $this->belongsTo('ProIMAN\OurCourse','our_course_id');
    }

    public function student(){
        return $this->belongsTo('ProIMAN\Student','student_id');
    }

    public function studentBill(){
        return $this->hasMany('ProIMAN\StudentBill','student_enroll_id');
    }
}
