{{-- resources/views/adminlte/users/index.blade.php --}}
@extends('layouts.user')

@section('pageTitle', 'Users')



@section('content')


    <div class="row">
        <div class="col-xs-12 mb-2">
            <a href="{{ route('users.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus mr-1"></i>Add User</a>
        </div>
    </div>


<div class="row">

    <div class="col-xs-12">

        @include('partials.flash-messages')

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users</h3>

                <div class="box-tools">

                </div>
            </div>

            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Roles</th>
                        <th>Date/Time Added</th>
                        <th>Actions</th>
                    </tr>

                    @if(!empty($users) && !$users->isEmpty())
                        @foreach ($users as $user)

                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                                <td>{{ Str::appDateFormat($user->created_at) }}</td>
                                <td class="action-icons">
										<a href="{{ route('users.show', $user->id) }}" class="btn btn-success pull-left"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success pull-left"><i class="fa fa-pencil"></i></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'name' => 'frm_delete' ]) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                                        {!! Form::close() !!}
                                   

                                   

                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" align="center">
                                {{ __('common.no-record-found') }}
                            </td>
                        </tr>
                    @endif

                </table>


                {{-- @if(!empty($users) && !$users->isEmpty())
                    <div class="text-center">
                        {{-- Page {{ $companies->currentPage() }} of {{ $companies->lastPage() }} --}}
                        {{-- {!! $users->links() !!}
                    </div>
                @endif --}}

            </div>
        </div>
    </div>

</div>

@endsection


@section('footer_assets')
    <script>
        $(document).ready(function(){

            $('table.table').on('submit', 'form[name=frm_delete]', function(e){
                e.preventDefault();

                currentForm = $(this);

                // Remove user
                swal.fire({
                    title: 'Are you sure to delete this user?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.value) {
                        currentForm[0].submit();
                    }
                });

            });
        });
    </script>

@endsection