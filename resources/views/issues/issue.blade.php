@extends('layout.master')
@inject('markdown', '\Michelf\MarkdownExtra')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <h4>#{{ $issue->id }} - {{ $issue->title }}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-default btn-sm" href="#newcomment" role="button">{{ trans('common.button_comment') }}</a>
            <a class="btn btn-default btn-sm" href="{{ url('edit/' . $issue->id) }}" role="button">{{ trans('common.button_edit') }}</a>
            <a class="btn btn-default btn-sm" href="{{ url('resolve/' . $issue->id) }}" role="button">{{ trans('common.button_resolve') }}</a>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <hr>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-3 col-sm-push-9">

            <div class="well well-sm small">
                <p>
                    <a href="{{ url('issues/project/' . $issue->project->id) }}"><strong>{{ $issue->project->name }}</a></strong>
                </p>

                <p>
                    {{ trans('common.assigned_to') }}:<br>
                    <img src="{{ gravatar($issue->created_by->email, 15) }}" class="img-circle">
                    <a href="{{ url('user/' . $issue->user->id) }}">{{ $issue->user->name }}</a>
                </p>
                <p>
                    <i class="fa {{ $issue->category->fa_icon }}" aria-hidden="true" title="{{ $issue->category->name }}"></i> {{ $issue->category->name }}
                </p>

                <p>
                    {{ $issue->priority->name }}
                </p>

                @if ($issue->milestone)
                <p>
                    {{ trans('common.milestone') }}: {{ $issue->milestone->name }}<br>
                    {{ $issue->milestone->milestone }}
                </p>
                @endif

                <p>
                    {{ trans('common.created_by') }}:<br>
                    @if ($issue->created_by->trashed())
                    <del>{{ $issue->created_by->name }}</del>
                    @else
                    <img src="{{ gravatar($issue->created_by->email, 15) }}" class="img-circle">
                    <a href="{{ url('user/' . $issue->created_by->id) }}">{{ $issue->created_by->name }}</a>
                    @endif
                </p>

                <p>
                    {{ trans('common.created') }}:<br>
                    {{ $issue->created_at->toDayDateTimeString() }}
                </p>

                <p>
                    {{ trans('common.updated') }}:<br>
                    {{ $issue->updated_at->toDayDateTimeString() }}
                </p>

                <a class="btn btn-primary btn-block" href="{{ url('assign/'.$issue->id) }}" role="button">Reassign</a>
                <a class="btn btn-success btn-block" href="{{ url('resolve/'.$issue->id) }}" role="button"> Resolve</a>

            </div>


        </div>


        <div class="col-sm-9 col-sm-pull-3">

            {!! $markdown->transform($issue->description) !!}

        </div>

    </div>


    @each('issues.partials.comment', $issue->posts, 'post')

    <div class="row">
        <div class="col-sm-12">
            <hr>
        </div>
    </div>


    @include('issues.partials.textarea')

@endsection