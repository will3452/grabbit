@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Home',
            'link' => '/home',
            'active' => false,
        ],
        [
            'label' => 'Create new post',
            'link' => '#',
            'active' => true
        ]
    ]"/>
@endsection
@section('content')
        <livewire:available />
@endsection
