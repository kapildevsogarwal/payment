@if($companyList->count() > 0)
@foreach ($companyList as $key => $company)
    <tr>
        <td>
            <a href="{{ route('search.show-company', [$company->id]) }}" title="View">
                {{ $company->name }} 
            </a>
        </td>
        <td>{{ $company->type }}</td>
        <td> {{ ($company->created_at)?date('d M, Y h:i:sa', strtotime($company->created_at)):'' }} </td>
        <td class="action-icons">
            <a href="{{ route('search.show-professional', [$company->id]) }}" title="View Detail" class="btn btn-success action-tooltip">
                <i class="fa fa-eye"></i>
            </a>
        </td>
    </tr>
@endforeach
@else
    <tr>
        <td colspan="4" align="center">
            No Record Found
        </td>
    </tr>
@endif
@if(!empty($companyList) && !$companyList->isEmpty())
    <tr>
        <td colspan="4" align="center">
            {{ $companyList->links( "pagination::bootstrap-4") }}
        </td>
    </tr>
@endif