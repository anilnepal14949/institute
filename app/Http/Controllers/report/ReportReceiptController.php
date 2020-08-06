<?php namespace ProIMAN\Http\Controllers\report;

use Illuminate\Support\Facades\DB;
use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;

use Illuminate\Http\Request;
use ProIMAN\ReceiptDetail;

class ReportReceiptController extends Controller {

	/**
	 * array
	 * @var
     */
	protected $pro_data;

	public function __construct()
	{

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$receipts = DB::table('pro_receipts')
			->leftJoin('pro_receipt_details',function($join){
				$join->on('pro_receipts.id','=','pro_receipt_details.receipt_id');
			})
			->leftJoin('pro_students',function($join){
				$join->on('pro_receipts.student_id','=','pro_students.id');
			})
			->leftJoin('pro_users_detail',function($join){
				$join->on('pro_students.user_id','=','pro_users_detail.id');
			})
			->select([
				'pro_users_detail.name as student_name',
				'pro_receipts.receipt_note',
				'pro_receipt_details.*',
			])
			->whereNull('pro_receipts.deleted_at')
			->get();
		$this->pro_data['receipts'] = empty($receipts)?'':$receipts;
		return view('report.report-receipt.index',$this->pro_data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{//

	}

}
