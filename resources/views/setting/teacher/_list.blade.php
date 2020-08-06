<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-heading-left">
            <h3 class="panel-title">Teachers</h3>
        </div>
        <div class="panel-heading-right">
            <a href="{{route('teacher.index')}}" title="Add Teacher" class="showToolTip" data-placement="left"><span class="glyphicon glyphicon-plus"></span></a> &nbsp;&nbsp;
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
                <th width="20%">
                    Address
                </th>
                <th width="10%">
                    Status
                </th>
                <th width="25%">
                    Actions
                </th>
            </tr>
            @if($teachers)
                <?php $i=1; ?>
                @foreach($teachers as $teacher1)
                    <tr @if(isset($teacher)) @if($teacher->user_id == $teacher1->id) class="info" @endif @endif>
                        <td>
                            {!! $i; !!}.
                        </td>
                        <td>
                            {!! $teacher1->name !!}
                        </td>
                        <td>
                            {!! $teacher1->address !!}
                        </td>
                        <td>
                            @if($teacher1->status == '0')
                                <label class="label label-success">Active</label>
                            @else
                                <label class="label label-danger">Inactive</label>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('setting.teacher.edit',$teacher1->id)}}" class="btn btn-info btn-xs showToolTip" title="Edit" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>

                            <a href="{{route('setting.teacher.show',$teacher1->id)}}" class="btn btn-warning btn-xs showToolTip" title="View" data-placement="top"><span class="glyphicon glyphicon-zoom-in"></span></a>

                            <a href="#" class="btn btn-danger btn-xs showToolTip confirmButton" title="Delete" data-placement="top" data-form-id="pro_my_form{{$i}}"><span class="glyphicon glyphicon-trash"></span></a>

                            {!! delete_form(['setting.teacher.destroy',$teacher1->id], 'pro_my_form'.$i++) !!}

                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">
                        <div class="alert alert-info" role="alert">
                            No any teachers recorded!! <br />Please add some teachers info using left side form.
                        </div>.
                    </td>
                </tr>
            @endif

        </table>
    </div>
</div>