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
    ]"/>
@endsection
@section('content')
<h1>Other Requests</h1>
<div class="list-group">
    @forelse ($meetupdata as $data)
        @if (!$data->CheckUserBlock())
            <a href="/meetup/request-meetup/{{$data->id}}/process" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$data->getPost()->title}}
                        @if ($data->approved_at)
                            <span class="badge badge-sm bg-success" >Approved</span>
                        @endif

                        @if ($data->declined_at)
                            <span class="badge badge-sm bg-danger" >Declined</span>
                        @endif
                    </h5>
                    <small class="text-muted">{{$data->created_at->diffForHumans()}}</small>
                </div>
                <small class="text-muted">{{$data->remarks}}</small>
            </a>
            @endif
    @empty
    <a class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">No data found.</h5>
        </div>
        </a>
    @endforelse
    <div class="mt-4">
            {{$meetupdata->links()}}
    </div>
</div>

        {{-- <div class="card mt-2">
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
        </div> --}}
@endsection
