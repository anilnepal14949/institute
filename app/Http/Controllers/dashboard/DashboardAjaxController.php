<?php namespace ProIMAN\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use PhpSpec\Wrapper\Subject;
use ProIMAN\Http\Controllers\Controller;

use ProIMAN\UserDetail;

class DashboardAjaxController extends Controller {

    /**
     * Show Course Type Level using course type id.
     * @param Request $request
     * @param UserDetail $userDetail
     * @return bool|string
     */
    public function feedUsers(Request $request, UserDetail $userDetail){

      if($request->ajax()){
          $input = $request->get('input');
          $selector = $request->get('selector');
          if($selector == 1){
              $userDetailInfo = $userDetail->search($input)->whereUser_type(3)->whereStatus('0')->orderBy('id','desc')->get();
          }else{
              $userDetailInfo = $userDetail->search($input)->whereStatus('0')->orderBy('id','desc')->get();
          }
          $return = '';
          if($userDetailInfo->isEmpty()){
              $return .= '<div class="pro_search_not_found">Sorry, Student Not Found :( !! Please Try Again!!</div>';
          }else{
              foreach($userDetailInfo as $user){
                  $url = route('setting.student.show',$user->id);
                  $return .= '<a href="'.$url.'" class="user_list_item"><div class="pro_search_name">'.$user->name.'</div><div class="pro_search_contact">'.$user->contact.'</div><div class="pro_search_address">'.$user->address.'</div><span class="clearfix"></span></a>';
              }
          }
          return $return;
        }
        return false;
    }

}
