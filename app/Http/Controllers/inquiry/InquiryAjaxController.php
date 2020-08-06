<?php namespace ProIMAN\Http\Controllers\inquiry;

use Illuminate\Http\Request;
use PhpSpec\Wrapper\Subject;
use ProIMAN\Http\Controllers\Controller;

use ProIMAN\Inquiry;

class InquiryAjaxController extends Controller {

    /**
     * Show Course Type Level using course type id.
     * @param Request $request
     * @param Inquiry $inquiry
     * @return bool|string
     */
    public function feedInquiries(Request $request, Inquiry $inquiry){

      if($request->ajax()){
          $input = $request->get('input');
          $return = '';
          $inquiryDetailInfo = $inquiry->search($input)->with('subject')->whereStatus('0')->get();

          if($inquiryDetailInfo->isEmpty()) {
              $return .= '<div class="alert alert-danger pro_result_table" role="alert">No Inquiries Found!</div>';
          }else{
              $return .= '<table class="table pro_result_table"><tr><th>S.N.</th><th>Name</th><th>Address</th><th>Contact</th><th>Subject</th><th>Date</th></tr>';
              $i=1;
              foreach($inquiryDetailInfo as $in){
                  $return .= '<tr><td>'.$i++.'</td><td>'.$in->name.'</td><td>'.$in->address.'</td><td>'.$in->contact.'</td><td>'.$in->subject->name.'</td><td>'.$in->created_at.'</td></tr>';
              }
              $return .= '</table>';
          }
          return $return;
        }
        return false;
    }

}
