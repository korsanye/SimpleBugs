@extends('layout.master')

@push('scripts')
<script src="/assets/datepicker/js/bootstrap-datepicker.min.js"></script>
<script>
    $('#inputMilestone').datepicker({
        language: "en",
        format: "yyyy-mm-dd"
    });
</script>
@endpush

@push('stylesheets')
<link href="/assets/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
@endpush


@section('content')

    <div class="row">

        @include('layout.partials.navadmin')

        <div class="col-md-10">

            <div class="row">
                <div class="col-md-12">


                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('common.edit_milestone') }}</div>
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
                                    <input type="text" name="name" class="form-control" id="inputName" placeholder="{{ trans('common.name')  }}" required="required" value="{{ old('name', $milestone->name) }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputMilestone">{{ trans('common.milestone_date') }}</label>
                                    <input type="text" name="milestone" class="form-control" id="inputMilestone" placeholder="{{ trans('common.milestone_date_placeholder')  }}" required="required" value="{{ old('nmilestone', $milestone->milestone) }}">
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