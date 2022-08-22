@if($objApprovalList->count() > 0)
    @foreach ($objApprovalList as $key => $company)
        <tr>
            <td>
                <a href="{{ route('company.details', [$company->id]) }}" title="View">
                {{ $company->company_name }}
                </a>
            </td>
            <td>
                
                    {{ $company->name }}    
                
            </td>
            <td>{{ $company->type }} </td>
            <td>
                {{ ($company->created_at)?date('d M, Y h:i:sa', strtotime($company->created_at)):'' }}  
            </td>
            <td class="action-icons">
                <div class="form-check form-check-inline">
                    <input type="checkbox" {{ (($company->status == '1')? 'checked':'') }} data-url="{{ route('search.approve-admin', [$company->aid])}}" class="form-check-input approve-admin"  value="{{$company->aid}}">
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
 @if(!empty($companylist) && !$companylist->isEmpty())
    <tr>
        <td colspan="7" align="center">
            {{ $companylist->links( "pagination::bootstrap-4") }}
        </td>
    </tr>
@endif