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

    <div class="card mt-3">
        <div class="card-header">Message Here</div>
        
        @livewire('message-livewire', ['read_by' => $data['read_by'], 'created_by' => $data['created_by'], 'conversation_id' => $data['conversation_id']])
    </div>
@endsection