@extends('layout.master')

@section('content')

    <h1>{{ trans('common.my_issues') }}</h1>

    @include('issues.partials.list')

@endsection