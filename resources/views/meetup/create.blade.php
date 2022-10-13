@extends('layouts.app')

@php
   $links = '/meetup/create/'.$postid;
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
    <livewire:meetup :postid="$postid"/>
    <script src="{{ asset('js/meetup.js') }}" defer></script>
@endsection
