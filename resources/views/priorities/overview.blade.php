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
                        <div class="panel-heading">{{ trans('common.priorities') }}</div>
                        <div class="panel-body">
                            <p>
                                {{ trans('common.priorities_description') }}
                            </p>
                            <p>
                                {{ trans('common.priorities_description_second') }}
                            </p>
                            <p>
                                {{ trans('common.priorities_description_third') }}
                            </p>
                            <a class="btn btn-default" href="{{ url('admin/priority/create') }}" role="button">{{ trans('common.create_priority' )}}</a>
                        </div>

                        <!-- Table -->
                        <table class="table table-striped small">
                            <thead>
                            <tr>
                                <th>{{ trans('common.name') }}</th>
                                <th class="hidden-xs">{{ trans('common.issues') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($priorities as $priority)
                                <tr>
                                    <td>
                                        {{ $priority->name }}
                                       @if ($priority->default )
                                            <span class="label label-primary">Default</span>
                                       @endif
                                    </td>
                                    <td class="hidden-xs">{{ count($priority->issues) }}</td>
                                    <td>
                                        <a class="btn btn-danger btn-xs pull-right" style="white-space: normal; margin-left: 5px;" href="{{ url('admin/priority/delete/' . $priority->id) }}" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <a class="btn btn-default btn-xs pull-right" style="white-space: normal; margin-left: 5px;" href="{{ url('admin/priority/edit/' . $priority->id) }}" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <a class="btn btn-default btn-xs pull-right {{ ($priority->default == true) ? 'disabled' : '' }}" style="white-space: normal; margin-left: 5px;" href="{{ url('admin/priority/default/' . $priority->id) }}" role="button"><i class="fa fa-star" aria-hidden="true"></i></a>
                                        <a class="btn btn-default btn-xs pull-right {{ ($priority->sort == 0) ? 'disabled' : '' }}" style="white-space: normal; margin-left: 5px;" href="{{ url('admin/priority/up/' . $priority->id) }}" role="button"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
                                        <a class="btn btn-default btn-xs pull-right {{ ($priority->sort == count($priorities) - 1) ? 'disabled' : '' }}" style="white-space: normal;" href="{{ url('admin/priority/down/' . $priority->id) }}" role="button"><i class="fa fa-angle-down" aria-hidden="true"></i></a>


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