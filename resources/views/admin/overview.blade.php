@extends('layout.master')

@section('content')

    <div class="row">

        @include('layout.partials.navadmin')

        <div class="col-md-10">

            <div class="row">

               <div class="col-xs-6 col-md-4">

                   <div class="panel status panel-danger">
                       <div class="panel-heading">
                           <h1 class="panel-title text-center">{{ $issues->filter(function($item) {return !$item->resolved;})->count() }}</h1>
                       </div>
                       <div class="panel-body text-center">
                           <strong>open issues</strong>
                       </div>
                   </div>



               </div>

                <div class="col-xs-6 col-md-4">

                    <div class="panel status panel-success">
                        <div class="panel-heading">
                            <h1 class="panel-title text-center">{{ $issues->filter(function($item) {return $item->resolved;})->count() }}</h1>
                        </div>
                        <div class="panel-body text-center">
                            <strong>resolved issues</strong>
                        </div>
                    </div>



                </div>

                <div class="col-xs-6 col-md-4">

                    <div class="panel status panel-default">
                        <div class="panel-heading">
                            <h1 class="panel-title text-center">{{ $users->count() }}</h1>
                        </div>
                        <div class="panel-body text-center">
                            <strong>Users</strong>
                        </div>
                    </div>



                </div>
            </div>




        </div>


    </div>

@endsection