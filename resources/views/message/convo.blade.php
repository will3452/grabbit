@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Home',
            'link' => '/home',
            'active' => false,
        ],
        [
            'label' => 'Conversation',
            'link' => '/convo',
            'active' => true
        ]
    ]"/>
@endsection

@section('content')

<div class="card mt-3 w-100" style="margin:auto;">
    <div class="card-header">Conversations</div>
    <div class="card-body">
        <div class="list-group">
            @foreach ($convo as $item)
            <a href="/convo/message/{{$item->geUserConvo()->id}}" style="text-decoration:none; color:#000">
                <li class="list-group-item d-flex justify-content-between align-items-baseline">
                    <div>
                        @if ($item->getProfileConvo()->avatar)
                            <img class="rounded-circle img-thumbnail object-fit-cover profile-avatar-size-convo" src="{{ asset('storage/'.$item->getProfileConvo()->avatar) }}" alt="">
                        @else 
                            <div class="no-profile-convo">
                                P
                            </div>
                        @endif
                    </div>
                    <div class="ms-2 me-auto">
                      <div>{{ucwords($item->geUserConvo()->name)}}</div>
                    </div>
                </li>
            </a>
            @endforeach
           
        </div>
    </div>
</div>

@endsection