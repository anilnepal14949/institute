<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-heading-left">
            <h3 class="panel-title">Course Types</h3>
        </div>
        <div class="panel-heading-right">
            <a href="{{route('course-type.index')}}" title="Add Course Type" class="showToolTip" data-placement="left"><span class="glyphicon glyphicon-plus"></span></a> &nbsp;&nbsp;
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
                <th width="20%">
                    Name
                </th>
                <th>
                    Description
                </th>
                <th width="10%">
                    Status
                </th>
                <th width="25%">
                    Actions
                </th>
            </tr>
            @if($courseTypes)
                <?php $i=1; ?>
                @foreach($courseTypes as $courseType1)
                    <tr @if(isset($courseType)) @if($courseType->id == $courseType1->id) class="info" @endif @endif>
                        <td>
                            {!! $i; !!}.
                        </td>
                        <td>
                            {!! $courseType1->name !!}
                        </td>
                        <td>
                            {!! $courseType1->description !!}
                        </td>
                        <td>
                            @if($courseType1->status == '0')
                                <label class="label label-success">Active</label>
                            @else
                                <label class="label label-danger">Inactive</label>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('setting.course-type.edit',$courseType1->id)}}" class="btn btn-info btn-xs showToolTip" title="Edit" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>

                            <a href="{{route('setting.course-type.show',$courseType1->id)}}" class="btn btn-warning btn-xs showToolTip" title="View" data-placement="top"><span class="glyphicon glyphicon-zoom-in"></span></a>

                            <a href="#" class="btn btn-danger btn-xs showToolTip confirmButton" title="Delete" data-placement="top" data-form-id="pro_my_form{{$i}}"><span class="glyphicon glyphicon-trash"></span></a>

                            {!! delete_form(['setting.course-type.destroy',$courseType1->id], 'pro_my_form'.$i++) !!}

                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">
                        <div class="alert alert-info" role="alert">
                            No any course types recorded!! <br />Please add some course types info using left side form.
                        </div>
                    </td>
                </tr>
            @endif

        </table>
    </div>
</div>