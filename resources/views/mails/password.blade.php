@extends('mails.singlecolumn')

@section('title')
    Lost Password
@endsection

@section('content')
You've requested a link for resetting your password.<br><br>

Click here to reset your password: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a><br><br>

In case you didn't request this link, just ignore this e-mail.
@endsection
