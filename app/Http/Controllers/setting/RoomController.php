<?php namespace ProIMAN\Http\Controllers\setting;

use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;
use ProIMAN\Room;
use ProIMAN\Http\Requests\setting\CreateRoomRequest;
use Illuminate\Session\Store as Session;

class RoomController extends Controller {
	/**
	 * @var array
	 */
	protected $pro_data;
	protected $room;

	/**
	 * Constructor.
	 *
	 * @param Session $session			The Session Class
	 * @param Room $room   				The Room Model
	 *
	 * @api
	 */
	public function __construct(Session $session, Room $room)
	{
		$this->room = $room;
		$this->session = $session;
		//$session->clear();

		// set session for pop up message.
		$session->has('store_success_info')?$this->pro_data['store_success_info'] = $session->pull('store_success_info'):'';
		$session->has('update_success_info')?$this->pro_data['update_success_info'] = $session->pull('update_success_info'):'';
		$session->has('delete_success_info')?$this->pro_data['delete_success_info'] = $session->pull('delete_success_info'):'';
		$session->has('redirect_to')?$this->pro_data['redirect_to'] = $session->pull('redirect_to'):'';
	}
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		$rooms = $this->room->orderBy('id','desc')->orderBy('updated_at','desc')->get();
		$this->pro_data['rooms'] = ($rooms->isEmpty())?'':$rooms;

		return view('setting.room.index',$this->pro_data);
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
	 * @param CreateRoomRequest $request
	 * @return Response
	 */
	public function store(CreateRoomRequest $request)
	{
		($request->get('status') == "on")?$status=0:$status=1;
		$fileName = '';
		if($request->file('image')){
			$fileName = time().$request->file('image')->getClientOriginalName();
			$this->uploadImage('room',$fileName,$request->file('image'));
		}
		$this->room->create([
			'name'=>$request->get('name'),
			'capacity'=>$request->get('capacity'),
			'number'=>$request->get('number'),
			'description'=>$request->get('description'),
			'image'=>$fileName,
			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		]);
		$this->session->flash('store_success_info','" room named '.$request->get('name').'"');
		return redirect()->route('room.index');
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
	 * @param Room $room
	 * @return Response
	 */
	public function edit(Room $room)
	{
		$rooms = $this->room->orderBy('id','desc')->orderBy('updated_at','desc')->get();
		return view('setting.room.edit',compact('room','rooms'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  CreateRoomRequest $request
	 * @param  Room $room
	 * @return Response
	 */
	public function update(CreateRoomRequest $request, Room $room)
	{
		$request->get('status') == 'on'?$status = 0:$status=1;
		$fileName = $oldFileName = $room->getAttribute('image');
		if($request->file('image')){
			$fileName = time().$request->file('image')->getClientOriginalName();
			$this->uploadImage('room',$fileName,$request->file('image'),$oldFileName);
		}
		$room->fill([
			'name'=>$request->get('name'),
			'capacity'=>$request->get('capacity'),
			'number'=>$request->get('number'),
			'description'=>$request->get('description'),
			'image'=>$fileName,
			'updated_by'=>2,
			'status'=>$status
		])->save();
		$this->session->flash('update_success_info','" room named '.$request->get('name').'"');
		return redirect()->route('room.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param  Room $room
	 * @return Response
	 */
	public function destroy(Room $room)
	{
		$roomName = $room->getAttribute('name');
		$room->delete();
		$this->session->flash('delete_success_info','" room named '.$roomName.'"');
		return redirect()->route('room.index');
	}

}
