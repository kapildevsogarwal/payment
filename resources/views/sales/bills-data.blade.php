@if($bills->count() > 0)
    @foreach ($bills as $key => $bill)
        <tr>
            <td>
                <a href="{{ route('sales.show', [$bill->id]) }}" title="View">
                    {{ $bill->invoice_no }}    
                </a>
            </td>
            <td>{{ date('M d, Y', strtotime($bill->invoice_date)) }}</td>
            <td>
				<a href="{{ route('party.show', [$bill->party_id]) }}" title="View">
						{{ $bill->party_name }}
				</a>
			</td>
            <td>{{ ($bill->created_at)?date('d M, Y h:i:sa', strtotime($bill->created_at)):'' }}  </td>
            <td class="action-icons">
                <a href="{{ route('sales.show', [$bill->id]) }}" title="View Detail" class="btn btn-success action-tooltip">
                    <i class="fa fa-eye"></i>
                </a>
                {{--<a href="{{ route('party.edit', [$party->id]) }}" title="Edit" class="btn btn-success action-tooltip">
                            <i class="fa fa-pencil"></i>
                </a>
                <a href="" class="btn btn-info action-tooltip"  title="Files">
                    <i class="fa fa-file-alt"></i>
                </a>--}}
                <a href="javascript::void(0);" data-url="{{ route('sales.destroy', [$bill->id]) }}" class="delete-party btn btn-danger action-tooltip" title="Delete">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" align="center">
            No Record Found
        </td>
    </tr>
@endif
 @if(!empty($bills) && !$bills->isEmpty())
    <tr>
        <td colspan="7" align="center">
            {{ $bills->links( "pagination::bootstrap-4") }}
        </td>
    </tr>
@endif