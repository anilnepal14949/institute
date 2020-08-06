<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model {

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pro_students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','status','created_by','updated_by','parent_contact','parent_name','parent_email','temp_parent_name','temp_parent_contact','associated_to','qualification','profession'];

    /**
     * A student belong to only one user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userDetail(){
        return $this->belongsTo('ProIMAN\UserDetail','user_id');
    }

    /**
     * A student can have many receipts.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receipt(){
        return $this->hasMany('ProIMAN\Receipt','student_id');
    }

    public function studentEnroll(){
        return $this->hasMany('ProIMAN\StudentEnroll','student_id');
    }

}
