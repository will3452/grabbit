@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Home',
            'link' => '/home',
            'active' => false,
        ],
        [
            'label' => 'Report',
            'link' => '/report',
            'active' => true
        ]
    ]"/>
@endsection
@section('content')
    <livewire:report :report="$datas['report_type']" :report_Id="$datas['report_id']"/> 
@endsection