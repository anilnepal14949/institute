<?php namespace ProIMAN\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Intervention\Image\ImageManagerStatic as Image;
//use Illuminate\Session\Store as Session;


abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	protected $sessionData;
	/**
	 * Constructor.
	 *
	 * @api
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getSession(){
		/*$session = '';
		$session->has('store_success_info')?$this->sessionData['store_success_info'] = $session->get('store_success_info'):'';
		$session->has('update_success_info')?$this->sessionData['update_success_info'] = $session->get('update_success_info'):'';
		$session->has('delete_success_info')?$this->sessionData['delete_success_info'] = $session->get('delete_success_info'):'';*/
	}
	public function uploadImage($pathName, $fileName, $imageFile, $oldFileName = null){
		$this->makeFolders($pathName);
		Image::make($imageFile->getRealPath())->heighten(100)->save('public/images/'.$pathName.'/thumbnail/thumbvtx'.$fileName);
		Image::make($imageFile->getRealPath())->save('public/images/'.$pathName.'/original/orivtx'.$fileName);
		Image::make($imageFile->getRealPath())->widen(400)->save('public/images/'.$pathName.'/'.$fileName);

		if($oldFileName != null){
			$this->removeFiles($pathName, $oldFileName);
		}
		return true;
	}
	// remove files
	public function removeFiles($pathName, $fileName){

		if(file_exists('public/images/'.$pathName.'/'.$fileName)){
			unlink('public/images/'.$pathName.'/'.$fileName);
		}
		if(file_exists('public/images/'.$pathName.'/original/orivtx'.$fileName)){
			unlink('public/images/'.$pathName.'/original/orivtx'.$fileName);
		}
		if(file_exists('public/images/'.$pathName.'/thumbnail/thumbvtx'.$fileName)){
			unlink('public/images/'.$pathName.'/thumbnail/thumbvtx'.$fileName);
		}
		return true;
	}

	// make folders
	public function makeFolders($pathName){
		if(!is_dir('public/images/'.$pathName)) mkdir('public/images/'.$pathName);
		if(!is_dir('public/images/'.$pathName.'/thumbnail')) mkdir('public/images/'.$pathName.'/thumbnail');
		if(!is_dir('public/images/'.$pathName.'/original')) mkdir('public/images/'.$pathName.'/original');
		return true;
	}

}
