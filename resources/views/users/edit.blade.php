@extends('layout.master')

@section('content')

    <div class="row">

        @include('layout.partials.navadmin')

        <div class="col-md-10">

            <div class="row">
                <div class="col-md-12">


                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('common.edit_user') }}</div>
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
                                    <input type="text" name="name" class="form-control" id="inputName" placeholder="{{ trans('common.name')  }}" required="required" value="{{ old('name', $user->name) }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail">{{ trans('common.email_address') }}</label>
                                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="{{ trans('common.email') }}" required="required" value="{{ old('email', $user->email) }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">{{ trans('common.password') }}</label>
                                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="{{ trans('common.password') }}">
                                    <span id="helpBlock" class="help-block">{{ trans('common.change_password_help') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordConfirm">{{ trans('common.confirm_password') }}</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirm" placeholder="{{ trans('common.confirm_password') }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputUsertype">{{ trans('common.usertype') }}</label>
                                    <select name="is_admin" class="form-control" id="inputUsertype">
                                        <option value="0" {{ (old('is_admin', $user->is_admin) == 0) ? 'selected="selected"' : '' }}>{{ trans('common.user') }}</option>
                                        <option value="1" {{ (old('is_admin', $user->is_admin) == 1) ? 'selected="selected"' : '' }}>{{ trans('common.administrator') }}</option>
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