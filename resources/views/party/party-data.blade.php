@if($partyList->count() > 0)
    @foreach ($partyList as $key => $party)
        <tr>
            <td>
                <a href="{{ route('party.show', [$party->id]) }}" title="View">
                    {{ $party->name }}    
                </a>
            </td>
            <td>{{ $party->email }}   </td>
            <td>{{ $party->address }} </td>
            <td>{{ $party->gst_number }}</td>
            <td>{{ ($party->created_at)?date('d M, Y h:i:sa', strtotime($party->created_at)):'' }}  </td>
            <td class="action-icons">
                <a href="{{ route('party.show', [$party->id]) }}" title="View Detail" class="btn btn-success action-tooltip">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{ route('party.edit', [$party->id]) }}" title="Edit" class="btn btn-success action-tooltip">
                            <i class="fa fa-pencil"></i>
                </a>
                {{--<a href="" class="btn btn-info action-tooltip"  title="Files">
                    <i class="fa fa-file-alt"></i>
                </a>--}}
                <a href="javascript::void(0);" data-url="{{ route('party.destroy', [$party->id]) }}" class="delete-party btn btn-danger action-tooltip" title="Delete">
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
 @if(!empty($partylist) && !$partylist->isEmpty())
    <tr>
        <td colspan="7" align="center">
            {{ $partylist->links( "pagination::bootstrap-4") }}
        </td>
    </tr>
@endif