@if($objApprovalList->count() > 0)
    @foreach ($objApprovalList as $key => $professional)
        <tr>
            <td>
                 <a href="{{ route('professional.show', [$professional->id]) }}" title="View">
                {{ $professional->first_name }}
                </a>
            </td>
            <td>
                {{ $professional->last_name }}
            </td>
			 <td>
                {{ $professional->name }}
            </td>
            <td>{{ $professional->type }} </td>
            <td>
                {{ ($professional->created_at)?date('d M, Y h:i:sa', strtotime($professional->created_at)):'' }}  
            </td>
            <td class="action-icons">
                <div class="form-check form-check-inline">
                    <input type="checkbox" {{ (($professional->status == '1')? 'checked':'') }} data-url="{{ route('search.professional-approve-admin', [$professional->aid])}}" class="form-check-input approve-admin"  value="{{$professional->aid}}">
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="6" align="center">
            No Record Found
        </td>
    </tr>
@endif
 @if(!empty($objApprovalList) && !$objApprovalList->isEmpty())
    <tr>
        <td colspan="6" align="center">
            {{ $objApprovalList->links( "pagination::bootstrap-4") }}
        </td>
    </tr>
@endif