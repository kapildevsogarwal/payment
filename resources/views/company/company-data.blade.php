@if($companylist->count() > 0)
    @foreach ($companylist as $key => $company)
        <tr>
            <td>
                <a href="{{ route('company.details', [$company->id]) }}" title="View">
                    {{ $company->name }}    
                </a>
            </td>
            <td>{{ $company->email }}   </td>
            <td>{{ $company->address }} </td>
            <td>{{ $company->type }}    {{$company->stripe_status}}</td>
            <td>{{ ($company->payment_id != '')?'Active':'Inactive' }}  </td>
            <td>{{ ($company->created_at)?date('d M, Y h:i:sa', strtotime($company->created_at)):'' }}  </td>
            <td class="action-icons">
                <a href="{{ route('company.details', [$company->id]) }}" title="View Detail" class="btn btn-success action-tooltip">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{ route('company.edit', [$company->id]) }}" title="Edit" class="btn btn-success action-tooltip">
                            <i class="fa fa-pencil"></i>
                </a>
                {{--<a href="" class="btn btn-info action-tooltip"  title="Files">
                    <i class="fa fa-file-alt"></i>
                </a>--}}
                <a href="javascript::void(0);" data-url="{{ route('company.destory', [$company->id]) }}" class="delete-company btn btn-danger action-tooltip" title="Delete">
                    <i class="fa fa-trash"></i>
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
 @if(!empty($companylist) && !$companylist->isEmpty())
    <tr>
        <td colspan="3" align="center">
            {{ $companylist->links( "pagination::bootstrap-4") }}
        </td>
    </tr>
@endif