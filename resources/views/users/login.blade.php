@extends('layouts.main')

@section('jumbotron')
    <h1  class = "display-3">Login</h1>
@endsection


@section('main_content')

    <style>
        form{
            background-color: greenyellow;
            border: 5px double deepskyblue ;

        }
    </style>
    <form action="/login" method="post">
        @include('layouts.embed.errors')

        {{csrf_field()}}


        <div class="form-group">

            <input required type="text" id="email" name="email" class="form-control" placeholder="Email">
        </div>

        <div class="form-group">

            <input required type="password" id="password" name="password" class="form-control" placeholder="Password">
        </div>



        <div class="form-group">
            <button class="btn btn-success">Login</button>
        </div>
    </form>
@endsection
