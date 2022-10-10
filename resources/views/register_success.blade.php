@extends('layouts.guest')

@section('content')
    <div class="text-center">
        You registered successfully, please wait for the account approval.
    </div>
    <div class="text-center">
        <a href="{{route('logout')}}">
            Ok, I understand.
        </a>
    </div>
@endsection
