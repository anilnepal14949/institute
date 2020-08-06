<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-heading-left">
            <h3 class="panel-title">Receipts of {{$studentEnrollInfo->name}}</h3>
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
                <th width="8%">
                    S.N.
                </th>
                <th width="25%">
                    Creation Date
                </th>
                <th width="20%">
                    Receipt No.
                </th>
                <th >
                    Receipt Note
                </th>
                <th width="30%">
                    Actions
                </th>
            </tr>
            @if($studentReceipts)
                <?php $i=1; ?>
                @foreach($studentReceipts as $studentReceipt1)
                    <tr>
                        <td>
                            {!! $i; !!}.
                        </td>
                        <td>
                            {!! date('Y-m-d',strtotime($studentReceipt1->created_at)) !!}
                        </td>
                        <td>
                            {!! $studentReceipt1->id !!}
                        </td>
                        <td>
                            {!! $studentReceipt1->receipt_note !!}
                        </td>
                        <td>
                            <a href="#" class="btn btn-info btn-xs showToolTip" title="Edit" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>

                            <a href="#" class="btn btn-warning btn-xs showToolTip" title="View" data-placement="top"><span class="glyphicon glyphicon-zoom-in"></span></a>

                            <a href="#" class="btn btn-danger btn-xs showToolTip confirmButton" title="Delete" data-placement="top" data-form-id="pro_my_form{{$i}}"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">
                        <div class="alert alert-info" role="alert">
                            No any receipts send!!
                        </div>
                    </td>
                </tr>
            @endif

        </table>
    </div>
</div>