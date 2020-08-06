<?php namespace ProIMAN;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiptDetail extends Model {

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pro_receipt_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['receipt_id','bill_no','status','created_by','updated_by','paid_amount','discount_amount'];

    /**
     * A receiptDetail belong to one receipt
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receipt(){
        return $this->belongsTo('ProIMAN\Receipt','receipt_id');
    }
}
