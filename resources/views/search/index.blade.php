@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Home',
            'link' => '/home',
            'active' => false,
        ],
        [
            'label' => 'Search',
            'link' => '/search',
            'active' => true
        ]
    ]"/>
@endsection
@section('content')
    <h1>Search Result</h1>
        <ul class="nav nav-pills mb-3 shadow-sm p-3 bg-body rounded" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="@if(isset($_GET['search'])) /result?search={{$_GET['search']}}&sort=post @endif" role="tab" aria-controls="pills-home" aria-selected="true">Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="@if(isset($_GET['search'])) /result?search={{$_GET['search']}}&sort=profile @endif" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
            </li>
          </ul>
          <div class="list-group">
            @php
                if(isset($_GET['sort'])){
                    $sort = $_GET['sort'];
                }else{
                    $sort = '';
                }
            @endphp
           @if ($sort == 'profile')
                @forelse ($datas as $data)
                    @if(!$data->CheckUserBlock())
                    <a href="/profile/show/{{$data->id}}" class="list-group-item list-group-item-action mb-3">
                        <div class="d-flex w-100 justify-content-between">
                            <li class="d-flex align-items-baseline">
                                    @if($data->profile()->first()->avatar)
                                        <div>
                                            <img class="rounded-circle img-thumbnail object-fit-cover profile-avatar-size-convo" src="{{ asset('storage/'.$data->profile()->first()->avatar) }}" alt="">
                                        </div>
                                    @else
                                        <div class="no-profile-convo">
                                            P 
                                        </div>
                                    @endif
                                    <h6 class="mb-1" style="margin-left:5px;"> {{$data->name}}</h6>
                            </li>
                        </div>
                    </a>
                    @endif
                @empty
                    <a class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">No data found.</h5>
                        </div>
                    </a>
                @endforelse
            @else
                @forelse ($datas as $data)
                    @if(!$data->CheckUserBlock())
                    <a href="/posts/{{$data->id}}" class="list-group-item list-group-item-action mb-3">
                        <div class="d-flex w-100 justify-content-between">
                            <li class="d-flex align-items-baseline">
                                @if ($data->getProfilePost()->avatar)
                                   <div>
                                        <img class="rounded-circle img-thumbnail object-fit-cover profile-avatar-size-convo" src="{{ asset('storage/'.$data->getProfilePost()->avatar) }}" alt="">
                                   </div>
                                @else 
                                <div class="no-profile-convo">
                                    P
                                </div>
                            @endif
                                    <h6 class="mb-1" style="margin-left:5px;"> {{ucwords($data->getUserPost()->name)}}</h6>
                            </li>
                            <small class="text-muted">{{$data->created_at->diffForHumans()}}</small>
                        </div>
                        <small>{{$data->title}}</small> <br>
                        <small class="text-muted">{{$data->descriptions}}</small>
                    </a> 
                    @endif
                @empty
                    <a class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">No data found.</h5>
                        </div>
                    </a>
                 @endforelse
            @endif
        </div>
@endsection