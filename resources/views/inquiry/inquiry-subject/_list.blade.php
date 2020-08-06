<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-heading-left">
            <h3 class="panel-title">Inquires</h3>
        </div>
        <div class="panel-heading-right">
            <a href="{{route('inquiry.inquiry-subject.create')}}" title="Add Inquiry" class="showToolTip" data-placement="left"><span class="glyphicon glyphicon-plus"></span></a> &nbsp;&nbsp;
            <span class="glyphicon glyphicon-minus"></span>
        </div>
    </div>
    <div class="panel-body">
        <!-- Table -->
        <table class="table">
            <tr>
                <th>
                    Name
                </th>
                <th width="20%">
                    Address
                </th>
				<th width="25%">
                    Subject
                </th>
                <th width="15%">
                    Date/Time
                </th>
                <th width="8%">
                    Status
                </th>
                <th width="25%">
                    Actions
                </th>
            </tr>
            @if($inquiries->isEmpty())
                <tr>
                    <td colspan="6">
                        <div class="alert alert-info" role="alert">
                            No any inquiries recorded!! <br />
                            Please add some inquiries using left side form.
                            <br />
                            <span class="glyphicon glyphicon-hand-left"></span>
                        </div>
                    </td>
                </tr>
            @else
                <?php $i=1; ?>
                @foreach($inquiries as $inquiry1)
                    <tr @if(isset($inquiry)) @if($inquiry->id == $inquiry1->id) @if(isset($inquiryView)) class="warning" @else class="info" @endif @endif @endif>
                        <td>
                            {!! $inquiry1->name !!}
                        </td>
                        <td>
                            {!! $inquiry1->address !!}
                        </td>
						<td>
                            {!! $inquiry1->subject->name !!}
                        </td>
                        <td>
                            <small>{!! date('jS F Y, g:i A',strtotime($inquiry1->created_at)) !!}</small>
                        </td>
                        <td>
                            @if($inquiry1->status == '0')
                                <label class="label label-success">Active</label>
                            @else
                                <label class="label label-danger">Inactive</label>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('inquiry.inquiry-subject.edit',$inquiry1->id)}}" class="btn btn-info btn-xs showToolTip" title="Edit" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>

                            <a href="{{route('inquiry.inquiry-subject.show',$inquiry1->id)}}" class="btn btn-warning btn-xs showToolTip" title="View" data-placement="top"><span class="glyphicon glyphicon-zoom-in"></span></a>

                            <a href="#" class="btn btn-danger btn-xs showToolTip confirmButton" title="Delete" data-placement="top" data-form-id="pro_my_form{{$i}}"><span class="glyphicon glyphicon-trash"></span></a>

                            {!! delete_form(['inquiry.inquiry-subject.destroy',$inquiry1->id], 'pro_my_form'.$i++) !!}

                        </td>
                    </tr>
                @endforeach
            @endif

        </table>
    </div>
</div>