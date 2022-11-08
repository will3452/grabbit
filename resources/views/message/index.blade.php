@extends('layouts.app')

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
            'active' => true
        ]
    ]"/>
@endsection

@section('content')
    @livewire('message-livewire', ['read_by' => $data['read_by'], 'created_by' => $data['created_by']])
@endsection
