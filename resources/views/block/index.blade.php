@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Home',
            'link' => '/home',
            'active' => false,
        ],
        [
            'label' => 'Block User',
            'link' => '#',
            'active' => true
        ],
    ]"/>
@endsection

@section('content')
    <h1>
        Block User
    </h1>
    <ul class="list-group">
        @forelse ($block as $item)
        <a href="{{route('block.blockuserlist')}}/{{$item->blocked_id}}/update" class="list-group-item list-group-item-action mb-3" style="cursor: pointer">
            <div class="d-flex w-100 justify-content-between">
                        <div class="d-flex align-items-baseline">
                            @if($item->getProfile()->avatar)
                            <div>
                                <img class="rounded-circle img-thumbnail object-fit-cover profile-avatar-size-convo" src="{{ asset('storage/'.$item->getProfile()->avatar) }}" alt="">
                            </div>
                                @else
                                    <div class="no-profile-convo">
                                        P 
                                    </div>
                                @endif
                            <h6 class="mb-1" style="margin-left:5px;">{{ucwords($item->getUser()->name)}}</h6>
                        </div>
                        <div>
                            <small class="text-muted">{{$item->created_at->diffForHumans()}}</small>
                        </div>
            </div>
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
        {{$block->links()}}
    </div>
@endsection
