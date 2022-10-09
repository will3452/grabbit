@extends('layouts.app')

@php
   $links = '/meetup/create/'.$posts->id;
@endphp
@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Home',
            'link' => '/home',
            'active' => false,
        ],
        [
            'label' => 'Posts',
            'link' => '/posts',
            'active' => false
        ],
        [
            'label' => 'Create Meetup',
            'link' => $links,
            'active' => true
        ]
    ]"/>
@endsection
@section('content')

    <div class="card">
        <div class="card-header">Meetup Request Form</div>
        <form class="card-body" id="create_meetup">
            @csrf
            <div class="form-group">
                <p><b>Post:</b> {{$posts->title}}</p>
            </div>
            <div class="form-group">
                <p><b>Description:</b> {{$posts->descriptions}}</p>
            </div>
            <div class="form-group">
                <p><b>Created:</b> <small>{{$posts->created_at->diffForHumans()}}</small></p>
            </div>
            <input type="hidden" id="post_id" name="post_id" value="{{$posts->id}}">
            <div class="form-group">
                <input  name="meetup_date" type="date" id="meetup_date" class="form-control" placeholder="date">
                <span class="text-danger meetup_date" style="font-size:15px; font-weight:700; margin-left:2px;"></span>
            </div>
            <div class="form-group mt-2">
                <textarea  name="remarks" id="remarks" placeholder="Remarks" class="form-control" id="remarks" rows="3"></textarea>
                <span class="text-danger remarks" style="font-size:15px; font-weight:700; margin-left:2px;"></span>
            </div>
            <div class="mt-2 form-group" style="text-align:right !important;">
                <button type="submit" class="btn btn-primary metupssbtn">
                    Create Meetup
                </button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/meetup.js') }}" defer></script>
@endsection
