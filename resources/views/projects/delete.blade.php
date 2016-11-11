@extends('layout.master')

@section('content')

    <div class="row">

        @include('layout.partials.navadmin')

        <div class="col-md-10">

            <div class="row">
                <div class="col-md-12">


                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('common.delete_user') }}</div>
                        <div class="panel-body">
                            <h3>{{ trans('common.confirm_deletion_user_header', ['name' => $project->name]) }}</h3>
                            <p>
                                {{ trans('common.confirm_deletion_project_text') }}
                            </p>
                            <p>
                                {{ trans_choice('common.confirm_deletion_project_text_second', count($project->issues), ['num' => count($project->issues)]) }}
                            </p>
                            <p>
                                <em>{{ trans('common.confirm_deletion_project_text_third') }}</em>
                            </p>

                            <form method="post" action="">
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-danger">{{ trans('common.confirm_delete_project') }}</button>
                            </form>


                        </div>

                    </div>



                </div>

            </div>




        </div>


    </div>

@endsection