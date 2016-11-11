@extends('layout.master')

@section('content')

    <div class="row">

        @include('layout.partials.navadmin')

        <div class="col-md-10">

            <div class="row">
                <div class="col-md-12">


                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('common.edit_project') }}</div>
                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="post" action="">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="inputName">{{ trans('common.name') }}</label>
                                    <input type="text" name="name" class="form-control" id="inputName" placeholder="{{ trans('common.name')  }}" required="required" value="{{ old('name', $project->name) }}">
                                </div>

                                <button type="submit" class="btn btn-default">{{ trans('common.update') }}</button>
                            </form>


                        </div>

                    </div>



                </div>

            </div>




        </div>


    </div>

@endsection