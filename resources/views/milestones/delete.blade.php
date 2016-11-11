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
                        <div class="panel-heading">{{ trans('common.delete_milestone') }}</div>
                        <div class="panel-body">
                            <h3>{{ trans('common.confirm_deletion_milestone_header', ['name' => $milestone->name]) }}</h3>
                            <p>
                                {{ trans('common.confirm_deletion_milestone_text') }}
                            </p>
                            <p>
                                {{ trans_choice('common.confirm_deletion_milestone_text_second', count($milestone->issues), ['num' => count($milestone->issues)]) }}
                            </p>

                            <form method="post" action="">
                                {!! csrf_field() !!}


                                <button type="submit" class="btn btn-danger">{{ trans('common.confirm_delete_milestone') }}</button>
                            </form>


                        </div>

                    </div>



                </div>

            </div>




        </div>


    </div>

@endsection