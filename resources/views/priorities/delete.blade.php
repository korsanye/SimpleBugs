@extends('layout.master')

@push('scripts')
<script src="/assets/select2/js/select2.min.js"></script>
<script>
    $('#inputNewPriority').select2({placeholder: "{{ trans('common.assign_to') }}"});
</script>
@endpush

@push('stylesheets')
<link href="/assets/select2/css/select2.min.css" rel="stylesheet">
@endpush


@section('content')

    <div class="row">

        @include('layout.partials.navadmin')

        <div class="col-md-10">

            <div class="row">
                <div class="col-md-12">


                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('common.delete_priority') }}</div>
                        <div class="panel-body">
                            <h3>{{ trans('common.confirm_deletion_priority_header', ['name' => $priority->name]) }}</h3>
                            <p>
                                {{ trans('common.confirm_deletion_priority_text') }}
                            </p>
                            <p>
                                {{ trans_choice('common.confirm_deletion_priority_text_second', count($priority->issues), ['num' => count($priority->issues)]) }}
                            </p>

                            <form method="post" action="">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label for="inputNewPriority">{{ trans('common.new_priority') }}</label>
                                    <select name="new_priority" class="form-control" id="inputNewPriority">
                                        @foreach ($priorities as $prio)
                                            <option value="{{ $prio->id }}">{{ $prio->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-danger">{{ trans('common.confirm_delete_priority') }}</button>
                            </form>


                        </div>

                    </div>



                </div>

            </div>




        </div>


    </div>

@endsection