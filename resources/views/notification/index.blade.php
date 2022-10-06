@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Home',
            'link' => '/home',
            'active' => false,
        ],
        [
            'label' => 'Notifications',
            'link' => '#',
            'active' => true
        ],
    ]"/>
@endsection

@section('content')
    <h1>
        Notifications
    </h1>
    <ul class="list-group">
        @forelse ($notifications as $item)
        <a class="list-group-item" href="{{route('notification.show', ['notification' => $item->id] )}}">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">
                    {{$item->remarks}}
                    @if (is_null($item->read_at))
                        <span class="badge bg-success badge-sm">unread</span>
                    @endif
                </h5>
                <small class="text-muted">{{$item->created_at->diffForHumans()}}</small>
            </div>
        {{-- <p class="mb-1">{{ucwords($data->getUserRequested()->name)}}</p>
         --}}

        </a>
    @empty
    <a class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">No data found.</h5>
        </div>
        </a>
    @endforelse
    </ul>

    <div class="mt-2">
        {{$notifications->links()}}
    </div>
@endsection
