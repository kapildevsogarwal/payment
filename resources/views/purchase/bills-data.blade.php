@if($purchases->count() > 0)
    @foreach ($purchases as $key => $purchase)
        <tr>
            <td>
                <a href="{{ route('purchase.show', [$purchase->id]) }}" title="View">
                    {{ $purchase->invoice_no }}    
                </a>
            </td>
            <td>{{ date('M d, Y', strtotime($purchase->invoice_date)) }}</td>
            <td>
				<a href="{{ route('party.show', [$purchase->party_id]) }}" title="View">
						{{ $purchase->party_name }}
				</a>
			</td>
            <td>{{ ($purchase->created_at)?date('d M, Y h:i:sa', strtotime($purchase->created_at)):'' }}  </td>
            <td class="action-icons">
                <a href="{{ route('purchase.show', [$purchase->id]) }}" title="View Detail" class="btn btn-success action-tooltip">
                    <i class="fa fa-eye"></i>
                </a>
                {{--<a href="{{ route('party.edit', [$purchase->id]) }}" title="Edit" class="btn btn-success action-tooltip">
                            <i class="fa fa-pencil"></i>
                </a>
                <a href="" class="btn btn-info action-tooltip"  title="Files">
                    <i class="fa fa-file-alt"></i>
                </a>--}}
                <a href="javascript::void(0);" data-url="{{ route('purchase.destroy', [$purchase->id]) }}" class="delete-purchase btn btn-danger action-tooltip" title="Delete">
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
 @if(!empty($purchases) && !$purchases->isEmpty())
    <tr>
        <td colspan="7" align="center">
            {{ $purchases->links( "pagination::bootstrap-4") }}
        </td>
    </tr>
@endif