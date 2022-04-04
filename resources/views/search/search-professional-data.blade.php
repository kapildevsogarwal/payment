@if($professionalList->count() > 0)
@foreach ($professionalList as $key => $professional)
    <tr>
        <td>
            <a href="{{ route('search.show-professional', [$professional->id]) }}" title="View">
                {{ $professional->first_name }} 
            </a>
        </td>
        <td>{{ $professional->last_name }}  </td>
        <td>{{ $professional->type }}    </td>
        <td>{{ $professional->experience }}</td>
        <td>{{ $professional->created_at }}</td>
        <td class="action-icons">
            <a href="{{ route('search.show-professional', [$professional->id]) }}" title="View Detail" class="btn btn-success action-tooltip">
                <i class="fa fa-eye"></i>
            </a>
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
@if(!empty($professionalList) && !$professionalList->isEmpty())
    <tr>
        <td colspan="6" align="center">
            {{ $professionalList->links( "pagination::bootstrap-4") }}
        </td>
    </tr>
@endif