<?php namespace ProIMAN\Http\Controllers\inquiry;

use ProIMAN\Http\Requests;
use ProIMAN\Http\Controllers\Controller;
use ProIMAN\Inquiry;
use ProIMAN\Subject;
use Illuminate\Session\Store as Session;

use ProIMAN\Http\Requests\inquiry\CreateInquirySubjectRequest;

class InquirySubjectController extends Controller {
	/**
	 * @var array
	 */
	protected $pro_data;
	protected $session;
	protected $subject;
	protected $inquiry;

	/**
	 * Constructor.
	 *
	 * @param Session $session				The Session Class
	 * @param Subject $subject  			The Subject Model
	 * @param Inquiry $inquiry
	 *
	 * @api
	 */
	public function __construct(Session $session, Subject $subject, Inquiry $inquiry)
	{

		$this->session = $session;
		$this->subject = $subject;
		$this->inquiry = $inquiry;

		$this->middleware('subject');

		// set session for pop up message.
		$session->has('store_success_info')?$this->pro_data['store_success_info'] = $session->get('store_success_info'):'';
		$session->has('update_success_info')?$this->pro_data['update_success_info'] = $session->get('update_success_info'):'';
		$session->has('delete_success_info')?$this->pro_data['delete_success_info'] = $session->get('delete_success_info'):'';
		$session->has('delete_file_success_info')?$this->pro_data['delete_file_success_info'] = $session->get('delete_file_success_info'):'';
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->setFormData();
		return view('inquiry.inquiry-subject.subjectwise',$this->pro_data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->setFormData();
		return view('inquiry.inquiry-subject.index',$this->pro_data);
	}

	/**
	 * Store a newly created resource in storage.
	 * @param CreateInquirySubjectRequest $request
	 * @return Response
	 */
	public function store(CreateInquirySubjectRequest $request)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$fileName = '';
		if($request->file('image')){
			$fileName = time().$request->file('image')->getClientOriginalName();
			$this->uploadImage('inquiry',$fileName,$request->file('image'));
		}

		$this->inquiry->create([
			'name'=>$request->get('name'),
			'subject_id'=>$request->get('subject_id'),
			'address'=>$request->get('address'),
			'contact'=>$request->get('contact'),
			'gender'=>$request->get('gender'),
			'email'=>$request->get('email'),
			'dob'=>$request->get('dob'),
			'image'=>$fileName,

			'parent_contact'=>$request->get('parent_contact'),
			'parent_name'=>$request->get('parent_name'),
			'parent_email'=>$request->get('parent_email'),
			'preferred_time'=>$request->get('preferred_time'),
			'other_preference'=>$request->get('other_preference'),

			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		]);

		$this->session->flash('store_success_info','" inquiry by person named '.$request->get('name').'"');
		return redirect()->route('inquiry.inquiry-subject.create');
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
	 * @param  Inquiry $inquiry
	 * @return Response
	 */
	public function edit(Inquiry $inquiry)
	{
		$this->setFormData();
		$this->pro_data['inquiry'] = $inquiry;
		return view('inquiry.inquiry-subject.edit',$this->pro_data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Inquiry $inquiry
	 * @param  CreateInquirySubjectRequest $request
	 * @return Response
	 */
	public function update(CreateInquirySubjectRequest $request, Inquiry $inquiry)
	{
		($request->get('status') == "on")?$status=0:$status=1;

		$fileName = $oldFileName = $inquiry->getAttribute('image');
		if($request->file('image')){
			$fileName = time().$request->file('image')->getClientOriginalName();
			$this->uploadImage('inquiry',$fileName,$request->file('image'),$oldFileName);
		}

		$inquiry->fill([
			'name'=>$request->get('name'),
			'subject_id'=>$request->get('subject_id'),
			'address'=>$request->get('address'),
			'contact'=>$request->get('contact'),
			'gender'=>$request->get('gender'),
			'email'=>$request->get('email'),
			'dob'=>$request->get('dob'),
			'image'=>$fileName,

			'parent_contact'=>$request->get('parent_contact'),
			'parent_name'=>$request->get('parent_name'),
			'parent_email'=>$request->get('parent_email'),
			'preferred_time'=>$request->get('preferred_time'),
			'other_preference'=>$request->get('other_preference'),

			'created_by'=>$request->user()->id,
			'updated_by'=>$request->user()->id,
			'status'=>$status
		])->save();

		$this->session->flash('update_success_info','" inquiry by person named '.$request->get('name').'"');
		return redirect()->route('inquiry.subject.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Inquiry $inquiry
	 * @return Response
	 */
	public function destroy(Inquiry $inquiry)
	{
		$userName = $inquiry->getAttribute('name');
		$inquiry->delete();
		$this->session->flash('delete_success_info','" inquiry by person named '.$userName.'"');
		return redirect()->route('inquiry.inquiry-subject.create');
	}

	public function setFormData(){
		$this->pro_data['subjects'] = $this->subject->with('courseTypeLevel')->whereStatus(0)->orderBy('course_type_level_id','desc')->get();
		$this->pro_data['inquiries'] = $this->inquiry->with('subject')->get();
	}
}
