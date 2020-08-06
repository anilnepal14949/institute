<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-heading-left">
            <h3 class="panel-title">Enrolled Students</h3>
        </div>
        <div class="panel-heading-right">
            <a href="{{route('enroll.student.index')}}" title="Enroll Student" class="showToolTip" data-placement="left"><span class="glyphicon glyphicon-plus"></span></a> &nbsp;&nbsp;
            <span class="glyphicon glyphicon-minus"></span>
        </div>
    </div>
    <div class="panel-body">
        <!-- Table -->
        <table class="table">
            <tr>
                <th width="5%">
                    S.N.
                </th>
                <th>
                    Name
                </th>
                <th width="18%">
                    Address
                </th>
				<th width="15%">
                    Our Course
                </th>
                <th width="8%">
                    Status
                </th>
                <th width="30%">
                    Actions
                </th>
            </tr>
            @if($enrollStudents->isEmpty())
                <tr>
                    <td colspan="6">
                        <div class="alert alert-info" role="alert">
                            No any students enrolled!! <br />Please enroll some students info using left side form.
                        </div>
                    </td>
                </tr>
            @else

                <?php $i=1; ?>
                @foreach($enrollStudents as $enrollStudent1)
                    <tr>
                        <td>
                            {!! $i; !!}.
                        </td>
                        <td>
                            {!! $enrollStudent1->student->userDetail->name !!}
                        </td>
                        <td>
                            {!! $enrollStudent1->student->userDetail->address !!}
                        </td>
						 <td>
                            {!! $enrollStudent1->ourCourse->name !!}
                        </td>
                        <td>
                            @if($enrollStudent1->status == '0')
                                <label class="label label-success">Active</label>
                            @else
                                <label class="label label-danger">Inactive</label>
                            @endif
                        </td>
                        <td>
                            @if($enrollStudent1->studentBill->isEmpty())
                                {!! Form::open(['route'=>'enroll.enroll-student-bill.store','method'=>'post','class'=>'form_inline']) !!}
                                {!! Form::hidden('student_enroll_id',$enrollStudent1->id) !!}
                                <button class="btn btn-success btn-xs showToolTip" title="Create Bill & Make Receipt" data-placement="top"><span class="glyphicon glyphicon-open-file"></span></button>
                                {!!Form::close()!!}
                            @else
                                <button class="btn btn-default btn-xs" type="button" data-toggle="popover" title="Bill already exists!!" data-content="Bill for this item has been already made. Please click on Show Bill and make receipt." data-placement="left" data-trigger="focus"><span class="glyphicon glyphicon-open-file"></span></button>
                            @endif

                            <a href="{{route('enroll.enroll-student.edit',$enrollStudent1->id)}}" class="btn btn-info btn-xs showToolTip" title="Edit" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>

                            <a href="{{route('enroll.enroll-student.show',$enrollStudent1->id)}}" class="btn btn-warning btn-xs showToolTip" title="View" data-placement="top"><span class="glyphicon glyphicon-zoom-in"></span></a>

                            <a href="#" class="btn btn-danger btn-xs showToolTip confirmButton" title="Delete" data-placement="top" data-form-id="pro_my_form{{$i}}"><span class="glyphicon glyphicon-trash"></span></a>

                            {!! delete_form(['enroll.enroll-student.destroy',$enrollStudent1->id], 'pro_my_form'.$i++) !!}

                        </td>
                    </tr>
                @endforeach
            @endif

        </table>
    </div>
</div>