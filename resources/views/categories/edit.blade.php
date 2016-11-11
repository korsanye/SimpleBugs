@extends('layout.master')

@push('scripts')
<script src="/assets/select2/js/select2.min.js"></script>
<script>

    function format(icon) {
        var originalOption = icon.element;
        return '<i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text;
    }

    $('#inputFaIcon').select2({
        placeholder: "{{ trans('common.icon_possibilities') }}",
        templateResult: format,
        escapeMarkup: function(m) {
            return m;
        }
    });
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
                        <div class="panel-heading">{{ trans('common.edit_category') }}</div>
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
                                    <input type="text" name="name" class="form-control" id="inputName" placeholder="{{ trans('common.name')  }}" required="required" value="{{ old('name', $category->name) }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputFaIcon">{{ trans('common.icon') }}</label>
                                    <select name="fa_icon" class="form-control" id="inputFaIcon" required="required">
                                        <option></option>
                                        @foreach ($icons as $icon)
                                        <option value="{{ $icon }}" data-icon="{{ $icon }}" {{ (old('fa_icon', $category->fa_icon) == $icon) ? 'selected="selected"' : '' }}>{{ $icon }}</option>
                                        @endforeach
                                    </select>
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