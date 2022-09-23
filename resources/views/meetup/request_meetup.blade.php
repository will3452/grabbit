@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Home',
            'link' => '/home',
            'active' => false,
        ],
        [
            'label' => 'Requesting Meetup',
            'link' => '/meetup/request-meetup',
            'active' => true
        ],
        [
            'label' => 'Requested Meetup',
            'link' => '/meetup/requested-meetup',
            'active' => false
        ]
    ]"/>
@endsection
@section('content')
        <div class="card mt-2">
            <div class="card-header">
                <div>Request Meetup</div>
            </div>
            <div class="card-body table_auto">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col" class="text-truncate">Remarks</th>
                        <th scope="col" class="text-truncate">Requestor</th>
                        <th scope="col" class="text-truncate">Post</th>
                        <th scope="col" class="text-truncate">Date Created</th>
                        <th scope="col" class="text-truncate">Approved At</th>
                        <th scope="col" class="text-truncate">Declined At</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($meetupdata as $data)
                            
                        <tr>
                            <td class="text-truncate">{{$data->remarks}}</td>
                            <td class="text-truncate"><a href="">{{ucwords($data->getUserPost()->name)}}</a></td>
                            <td class="text-truncate"><a href="">{{$data->getPost()->title}}</a></td>
                            <td class="text-truncate">{{$data->created_at->diffForHumans()}}</td>
                            <td class="text-truncate">{{$data->approved_at ?: '-----'}}</td>
                            <td class="text-truncate">{{$data->declined_at ?: '-----'}} </td>
                            <td class="text-truncate">
                                <div class="d-flex justify-content-center">
                                    <a href="/meetup/request-meetup/{{$data->id}}/process" class="btn btn-outline-primary m-1">Process</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $meetupdata->links("pagination::bootstrap-4") }}
            </div>
        </div>
@endsection