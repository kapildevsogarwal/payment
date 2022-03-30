@if(!empty($userlist) && !$userlist->isEmpty())
                        @foreach ($userlist as $key => $user)
                            <tr>
                                <td>
                                    <a href="{{ route('home.show', [$user->id]) }}" title="View">
                                        {{ $user->name }}   
                                    </a>
                                </td>
                                <td>{{ $user->first_name }} </td>
                                <td>{{ $user->last_name }}  </td>
                                <td>{{ $user->email }}  </td>
                                <td>
                                    {{($user->payment_id != '')?'Active':'Inactive'}}
                                </td>
                                <td>
                                    {{ ($user->pay_time)?date('d M, Y h:i:sa', strtotime($user->pay_time)):'Not Done' }}</td>
                                <td class="action-icons">
                                    <a href="{{ route('home.show', [$user->id]) }}" title="View Detail" class="btn btn-success action-tooltip">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('profile.user', [$user->id]) }}" title="Edit" class="btn btn-success action-tooltip">
                                                <i class="fa fa-pencil"></i>
                                    </a>
                                     <a href="javascript::void(0);" data-url="{{ route('home.destroy', [$user->id]) }}" class="delete-delivery-note btn btn-danger action-tooltip" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                    {{--<a href="" class="btn btn-info action-tooltip"  title="Files">
                                        <i class="fa fa-file-alt"></i>
                                    </a>
                                    <a href="javascript::void(0);" data-url="dddd" class="delete-company btn btn-danger action-tooltip" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>--}}
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
                        @if(!empty($userlist) && !$userlist->isEmpty())
                            <tr>
                                <td colspan="7" align="center">
                                    {{ $userlist->links( "pagination::bootstrap-4") }}
                                </td>
                            </tr>
                        @endif