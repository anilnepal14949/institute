<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referer extends Model {

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pro_referers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','status','created_by','updated_by','qualification','profession','relation','description'];

    /**
     * A referer belong to only one user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userDetail(){
        return $this->belongsTo('ProIMAN\UserDetail','user_id');
    }

}
