@extends('layout.master')

@section('content')

    @if (Session::get('success.message'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="{{ trans('common.close') }}"><span aria-hidden="true">&times;</span></button>
        <strong>{{ trans('common.success') }}!</strong> {{ Session::get('success.message') }}
    </div>
    @endif

    @if (Session::get('error.message'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="{{ trans('common.close') }}"><span aria-hidden="true">&times;</span></button>
            <strong>{{ trans('common.error') }}!</strong> {{ Session::get('error.message') }}
        </div>
    @endif

    <div class="row">

        @include('layout.partials.navadmin')

        <div class="col-md-10">

            <div class="row">
                <div class="col-md-12">


                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('common.users') }}</div>
                        <div class="panel-body">
                            <p>
                                {{ trans_choice('common.current_active_users', count($users), ['num_users' => count($users)]) }}
                            </p>
                            <p>
                                <a class="btn btn-default" href="{{ url('admin/user/create') }}" role="button">{{ trans('common.create_user' )}}</a>
                                @if (Request::is('admin/users'))
                                    <a class="btn btn-default" href="{{ url('admin/users/inactive') }}" role="button">{{ trans('common.show_inactive_users' )}}</a>
                                @else
                                    <a class="btn btn-default" href="{{ url('admin/users') }}" role="button">{{ trans('common.show_active_users' )}}</a>
                                @endif

                            </p>

                        </div>

                        <!-- Table -->
                        <table class="table table-striped small">
                            <thead>
                            <tr>
                                <th>{{ trans('common.name') }}</th>
                                <th class="hidden-xs">{{ trans('common.email') }}</th>
                                <th class="hidden-xs">{{ trans('common.created_at') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td class="hidden-xs">{{ $user->email }}</td>
                                <td class="hidden-xs">{{ $user->created_at }}</td>
                                <td>
                                    @if (Request::is('admin/users'))
                                        @if( Auth::user()->id != $user->id)
                                        <a class="btn btn-danger btn-xs pull-right" style="white-space: normal; margin-left: 5px;" href="{{ url('admin/user/delete/' . $user->id) }}" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <a class="btn btn-default btn-xs pull-right" style="white-space: normal;" href="{{ url('admin/user/edit/' . $user->id) }}" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        @endif
                                    @else
                                        <a class="btn btn-default btn-xs pull-right" style="white-space: normal;" href="{{ url('admin/user/activate/' . $user->id) }}" role="button"><i class="fa fa-user-plus" title="{{ trans('common.activate') }}" aria-hidden="true"></i></a>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>



                </div>

            </div>




        </div>


    </div>

@endsection