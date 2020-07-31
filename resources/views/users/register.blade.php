@extends('layouts.main')

@section('jumbotron')

@endsection


@section('main_content')
    <style>
        .formd{
            width: 40%;

            background-color: #3b58cd;
        }
        form-control{
            background-color:  #3b58cd;
        }
    </style>
    <div class="formd">
    <legend style="color: white">Registration</legend>
    <form action="/register" method="post">
        @include('layouts.embed.errors')

        {{csrf_field()}}
        <div class="form-group">
            <input  required type="text" id="name" name="name" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">

            <input required type="email" id="email" name="email" class="form-control" placeholder="Email">
        </div>

        <div class="form-group">
            <input required type="password" id="password" name="password" class="form-control" placeholder="Password">
        </div>

        <div class="form-group">

            <input required type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Password one more time">
        </div>

        <div class="form-group">
            <button class="btn btn-white">Register</button>
        </div>
    </form>
    </div>
@endsection
