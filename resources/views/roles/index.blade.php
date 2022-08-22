{{-- \resources\views\adminlte\roles\index.blade.php --}}
@extends('layouts.user')

@section('pageTitle', 'Roles')

@section('content')


    <div class="row">
        <div class="col-xs-12 mb-2">
            <a href="{{ route('roles.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus mr-1"></i>Add Role</a>
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
                        <th width="5%">ID</th>
                        <th width="10%">Role</th>
                        <th width="60%">Permission</th>
                        <th width="15%">Date/Time Added</th>
                        <th width="10%">Actions</th>
                    </tr>

                    @if(!empty($roles) && !$roles->isEmpty())
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                                <td>{{ Str::appDateFormat($role->created_at) }}</td>
                                <td class="action-icons">
                                    @can('Edit Role')
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-success pull-left"><i class="fa fa-pencil"></i></a>
                                    @endcan

                                    @can('Delete Role')
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'name' => 'frm_delete' ]) !!}
                                            {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                                        {!! Form::close() !!}
                                    @endcan

                                    {{-- <a href="javascript::void(0);" data-url="{{ route('companies.destroy', [$company->id]) }}" class="delete-company btn btn-danger" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a> --}}

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
                    title: 'Are you sure to delete this role?',
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