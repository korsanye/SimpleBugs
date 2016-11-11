@extends('layout.errors')

@section('content')

    <div class="row text-center">
        <h1>[404] {{ trans('common.whoops') }}</h1>
    </div>
    <div class="row text-center">
        <p class="lead">{{ trans('common.sorry') }}</p>
        <p>
            {!! trans('common.how_about_looking_at_your_issues', ['link' => url('issues/mine')]) !!}
        </p>
    </div>

@endsection