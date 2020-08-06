<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;


class StudentBill extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pro_student_bills';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['bill_no','student_id', 'our_course_id','student_enroll_id','bill_type','amount','tax','due','status','created_by','updated_by'];

    public function studentEnroll(){
        return $this->belongsTo('ProIMAN\StudentEnroll','student_enroll_id');
    }

    public function ourCourse(){
        return $this->belongsTo('ProIMAN\OurCourse','our_course_id');
    }

}
