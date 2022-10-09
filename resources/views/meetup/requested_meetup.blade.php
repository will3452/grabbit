@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Home',
            'link' => '/home',
            'active' => false,
        ],
        [
            'label' => 'Requested Meetup',
            'link' => '/meetup/requested-meetup',
            'active' => True
        ]
    ]"/>
@endsection
@section('content')
        <h1>My Request</h1>
        <div class="list-group">
            @forelse ($meetupdata as $data)
                 @if (!$data->CheckUserBlock())
                        <a class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$data->getPost()->title}}
                                @if (! is_null($data->approved_at))
                                    <span class="badge badge-sm bg-success" >Approved</span>
                                @endif

                                @if (! is_null($data->declined_at))
                                    <span class="badge badge-sm bg-danger" >Declined</span>
                                @endif
                            </h5>
                            <small class="text-muted">{{$data->created_at->diffForHumans()}}</small>
                        </div>
                        <p class="mb-1">{{ucwords($data->getUserRequested()->name)}}</p>
                        <small class="text-muted">{{$data->remarks}}</small>
                        </a>
                        @endif
            @empty
            <a class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">No data found.</h5>
                </div>
                </a>
            @endforelse
          </div>
@endsection
