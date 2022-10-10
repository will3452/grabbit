@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Dashboard',
            'active' => false,
            'link' => '/home',
        ]
    ]"></x-breadcrumb>
@endsection

@section('content')
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="card mb-4 text-white bg-primary">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold">{{\App\Models\User::count()}}</span></div>
                <div>Users</div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-->

        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
          <div class="card mb-4 text-white bg-warning">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold">{{\App\Models\Post::whereUserId(auth()->id())->count()}}</div>
                <div>Your Post</div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
          <div class="card mb-4 text-white bg-danger">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold">{{\App\Models\Follow::whereFollowingId(auth()->id())->count()}}</div>
                <div>Your Followers</div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
    </div>
  </div>
@endsection
