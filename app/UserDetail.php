<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class UserDetail extends Model {

    use SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'name' => 10,
            'address' => 10,
            'dob' => 2,
            'contact' => 5,
            'email' => 5,
            'gender' => 5,
        ]
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pro_users_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'address', 'email', 'status','created_by','updated_by','contact','gender','dob','image','user_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student(){
        return $this->hasOne('ProIMAN\Student','user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacher(){
        return $this->hasOne('ProIMAN\Teacher','user_id');
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function referer(){
        return $this->hasOne('ProIMAN\Referer','user_id');
    }

}
