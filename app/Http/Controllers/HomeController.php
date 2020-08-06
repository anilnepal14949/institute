<?php namespace ProIMAN\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\Store as Session;

class HomeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('dashboard');
	}
	public function enroll()
	{
		return view('enroll');
	}
	public function courses()
	{
		return view('courses');
	}
	public function reports()
	{
		return view('reports');
	}

	/**
	 * Delete Files.
	 *
	 * @param Request $request
	 * @param Session $session
	 * @return redirect()
	 */
	public function delete_file(Request $request, Session $session){
		$filePath =$request->get('filePath');
		$fileType = $request->get('fileType');
		$fileName = $request->get('fileName');

		if(strtolower($fileType) == 'image'){
			$path = 'public/images/'.$filePath.'/';
		}elseif(strtolower($fileType) == 'document'){
			$path = 'public/documents/'.$filePath.'/';
		}else{
			$path = '';
		}

		if(file_exists($path.$fileName)){
			unlink($path.$fileName);
		}
		if(file_exists($path.'original/orivtx'.$fileName)){
			unlink($path.'original/orivtx'.$fileName);
		}
		if(file_exists($path.'thumbnail/thumbvtx'.$fileName)){
			unlink($path.'thumbnail/thumbvtx'.$fileName);
		}

		$session->flash('delete_file_success_info','" image file"');
		return redirect()->back();
	}
}
