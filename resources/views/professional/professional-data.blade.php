@if($professionalList->count() > 0)
@foreach ($professionalList as $key => $professional)
    <tr>
        <td>
            <a href="{{ route('professional.show', [$professional->id]) }}" title="View">
                {{ $professional->first_name }} 
            </a>
        </td>
        <td>{{ $professional->last_name }}  </td>
        <td>{{ $professional->address }}    </td>
        <td>{{ $professional->type }}</td>
        <td>{{ $professional->experience }}</td>
        <td>{{ ($professional->payment_id != '')?'Active':'Inactive' }}   </td>
        <td>{{ ($professional->created_at)?date('d M, Y h:i:sa', strtotime($professional->created_at)):'' }}    </td>
        <td class="action-icons">
            <a href="{{ route('professional.show', [$professional->id]) }}" title="View Detail" class="btn btn-success action-tooltip">
                <i class="fa fa-eye"></i>
            </a>
            <a href="{{ route('professional.edit', [$professional->id]) }}" title="Edit" class="btn btn-success action-tooltip">
                        <i class="fa fa-pencil"></i>
            </a>
            {{--<a href="" class="btn btn-info action-tooltip"  title="Files">
                <i class="fa fa-file-alt"></i>
            </a>--}}
            <a href="javascript::void(0);" data-url="{{ route('professional.destory', [$professional->id])}}" class="delete-professional btn btn-danger action-tooltip" title="Delete">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
@endforeach
@else
    <tr>
        <td colspan="8" align="center">
            No Record Found
        </td>
    </tr>
@endif
@if(!empty($professionalList) && !$professionalList->isEmpty())
    <tr>
        <td colspan="8" align="center">
            {{ $professionalList->links( "pagination::bootstrap-4") }}
        </td>
    </tr>
@endif