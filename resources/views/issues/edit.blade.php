@extends('layout.master')

@push('scripts')
<script src="/assets/select2/js/select2.min.js"></script>
<script>
    $('#assign').select2({placeholder: "{{ trans('common.assign_to') }}"});
    $('#category').select2({placeholder: "{{ trans('common.category') }}"});
    $('#priority').select2({placeholder: "{{ trans('common.priority') }}"});
    $('#project').select2({placeholder: "{{ trans('common.project') }}"});
    $('#milestone').select2({placeholder: "{{ trans('common.milestone') }}"});
</script>
@endpush

@push('stylesheets')
<link href="/assets/select2/css/select2.min.css" rel="stylesheet">
@endpush



@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>{{ trans('common.edit_issue') }}</h2>
        </div>
    </div>

    <form method="post" action="">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="assign">{{ trans('common.assignee') }}</label>
                    <select name="user_id" id="assign" class="form-control">
                        <option></option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ (old('user_id', $issue->user->id) == $user->id) ? 'selected="selected"' : ''  }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="category">{{ trans('common.category') }}</label>
                    <select name="category_id" id="category" class="form-control">
                        <option></option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id', $issue->category->id) == $category->id) ? 'selected="selected"' : ''  }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="priority">{{ trans('common.priority') }}</label>
                    <select name="priority_id" id="priority" class="form-control">
                        <option></option>
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}" {{ (old('priority_id', $issue->priority->id) == $priority->id) ? 'selected="selected"' : ''  }}>{{ $priority->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="project">{{ trans('common.project') }}</label>
                    <select name="project_id" id="project" class="form-control">
                        <option></option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" {{ (old('project_id', $issue->project->id) == $project->id) ? 'selected="selected"' : ''  }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label for="milestone">{{ trans('common.milestone') }}</label>
                    <select name="milestone_id" id="milestone" class="form-control">
                        <option></option>
                        @foreach ($milestones as $milestone)
                            <option value="{{ $milestone->id }}" {{ (old('milestone_id', ($issue->milestone) ? $issue->milestone->id : false) == $milestone->id) ? 'selected="selected"' : ''  }}>{{ $milestone->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="estimate">{{ trans('common.estimate') }}</label>
                    <input type="text" name="estimate" value="{{ old('estimate', fromTime($issue->estimate)) }}" class="form-control" placeholder="{{ trans('common.estimate_placeholder') }}">
                </div>
            </div>



        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">{{ trans('common.issue_title') }}</label>
                    <input type="text" class="form-control" required="required" id="title" name="title" placeholder="{{ trans('common.issue_title_help') }}" value="{{ old('title', $issue->title) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">{{ trans('common.issue_description') }}</label>
                    <textarea required="required" class="form-control" rows="5" placeholder="" id="description" name="description">{{ old('description', $issue->description) }}</textarea>
                    <span id="helpBlock" class="help-block">{{ trans('common.you_can_use_markdown') }}</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <input class="btn btn-primary btn-lg btn-block" type="submit" value="{{ trans('common.assign_issue') }}">
            </div>
        </div>
    </form>
@endsection