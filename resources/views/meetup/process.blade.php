@extends('layouts.app')
@php
     $links = '/meetup/request-meetup/'.$meetupdata->id.'/process';
@endphp
@section('breadcrumb')
<x-breadcrumb :links="[
    [
        'label' => 'Home',
        'link' => '/home',
        'active' => false,
    ],
    [
        'label' => 'Requesting Meetup',
        'link' => '/meetup/request-meetup',
        'active' => false
    ],
    [
        'label' => 'Requested Meetup',
        'link' => '/meetup/requested-meetup',
        'active' => false
    ],
    [
        'label' => 'Process',
        'link' =>  $links,
        'active' => true
    ]
]"/>
@endsection
@section('content')

    <div class="card">
        <div class="card-header">Process Meetup Form</div>
        <form class="card-body" id="process_meetup" method="POST" action="/meetup/request-meetup">
            @csrf
            <div class="form-group">
                <p><b>Post:</b> {{$meetupdata->getPost()->title}}</p>
            </div>
            <div class="form-group">
                <p><b>Description:</b> {{$meetupdata->getPost()->descriptions}}</p>
            </div>
            <div class="form-group">
                <p><b>Created:</b> <small>{{$meetupdata->getPost()->created_at->diffForHumans()}}</small></p>
            </div>
            <div class="form-group">
                <p><b>Requestor Name:</b> <small>{{ucwords($meetupdata->getUserPost()->name)}}</small></p>
            </div>
            <input type="hidden" id="meetup_id" name="meetup_id" value="{{$meetupdata->id}}">
            <div class="form-group">
                <input class="form-control" type="text" readonly value="{{$meetupdata->meetup_date}}">
            </div>
            <div class="form-group mt-2">
                <textarea placeholder="Remarks" class="form-control" readonly rows="3">{{$meetupdata->remarks}}</textarea>
            </div>
            <div class="form-group mt-2">
                <select class="form-control" id="process" name="process">
                    <option value="">Select Process</option>
                    <option value="accept">Accept</option>
                    <option value="decline">Decline</option>
                </select>
                <span class="text-danger process" style="font-size:15px; font-weight:700; margin-left:2px;"></span>
            </div>
            <div class="mt-2 form-group" style="text-align:right !important;">
                <button type="submit" class="btn btn-primary metupssbtn">
                    Process Meetup
                </button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/meetup.js') }}" defer></script>
@endsection
