<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Inquiry extends Model {
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
            'contact' => 5,
            'email' => 5,
        ]
    ];
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pro_subject_inquiries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['subject_id','status','image','created_by','updated_by','parent_contact','parent_name','parent_email','name','address','contact','email','preferred_time','other_preference'];


    /**
     * A inquiry belong to a subject.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject(){
        return $this->belongsTo('ProIMAN\Subject','subject_id');
    }

}
