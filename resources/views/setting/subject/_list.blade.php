<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-heading-left">
            <h3 class="panel-title">Subjects</h3>
        </div>
        <div class="panel-heading-right">
            <a href="{{route('subject.index')}}" title="Add Subject" class="showToolTip" data-placement="left"><span class="glyphicon glyphicon-plus"></span></a> &nbsp;&nbsp;
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
                <th width="15%">
                    Course Type
                </th>
                <th width="15%">
                    Course Level
                </th>
                <th width="10%">
                    Status
                </th>
                <th width="25%">
                    Actions
                </th>
            </tr>
            @if($subjects)
                <?php $i=1; ?>
                @foreach($subjects as $subject1)
                    <tr @if(isset($subject)) @if($subject->id == $subject1->id) class="info" @endif @endif>
                        <td>
                            {!! $i !!}.
                        </td>
                        <td>
                            {!! $subject1->name !!}
                        </td>
                        <td>
                            {!! $subject1->courseTypeLevel->courseType->name !!}
                        </td>
                        <td>
                            {!! $subject1->courseTypeLevel->name !!}
                        </td>

                        <td>
                            @if($subject1->status == '0')
                                <label class="label label-success">Active</label>
                            @else
                                <label class="label label-danger">Inactive</label>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('setting.subject.edit',$subject1->id)}}" class="btn btn-info btn-xs showToolTip" title="Edit" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>

                            <a href="{{route('setting.subject.show',$subject1->id)}}" class="btn btn-warning btn-xs showToolTip" title="View" data-placement="top"><span class="glyphicon glyphicon-zoom-in"></span></a>

                            <a href="#" class="btn btn-danger btn-xs showToolTip confirmButton" title="Delete" data-placement="top" data-form-id="pro_my_form{{$i}}"><span class="glyphicon glyphicon-trash"></span></a>

                            {!! delete_form(['setting.subject.destroy',$subject1->id], 'pro_my_form'.$i++) !!}

                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <div class="alert alert-info" role="alert">
                            No any subjects recorded!! <br />Please add some subjects info using left side form.
                        </div>
                    </td>
                </tr>
            @endif

        </table>
    </div>
</div>