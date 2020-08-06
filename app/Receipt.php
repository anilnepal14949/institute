<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model {

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pro_receipts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id','status','created_by','updated_by','receipt_note'];

    /**
     * A receipt has many receipt detail.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receiptDetail(){
        return $this->hasMany('ProIMAN\ReceiptDetail','receipt_id');
    }

    /**
     * A receipt belongs to a student.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(){
        return $this->belongsTo('ProIMAN\Student','student_id');
    }
}
