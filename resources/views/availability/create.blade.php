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
       
<div class="card">
    <div class="card-header">Create new post</div>
    <form class="submitdate card-body">
        @csrf
        <div class="form-group mt-3">
            <input type="text" id="date" class="form-control  @error('date') is-invalid @enderror" id="date" name="date" class="focusinput" placeholder="yy-mm-dd">
            <span class="text-danger">
                <strong class="date"></strong>
            </span>
        </div>
        <div class="form-group mt-3">
            <label for="starttime">Start Time</label>
            <input type="time" class="form-control  @error('starttime') is-invalid @enderror"id="starttime" name="starttime" placeholder="starttime">
            <span class="text-danger">
                <strong class="starttime"></strong>
            </span>
        </div>
        <div class="form-group mt-3">
            <label for="endtime">End Time</label>
            <input type="time" class="form-control  @error('endtime') is-invalid @enderror" id="endtime" name="endtime" placeholder="endtime">
            <span class="text-danger">
                <strong class="endtime"></strong>
            </span>
        </div>
        <div class="form-group mt-4">
            <button type="submit" id="submitdata" class="btn btn-outline-primary w-100 p-2">
                Submit
            </button>
        </div>
   </form>
   <script src="{{ asset('js/availability.js') }}"></script>
   <script>
        
      
    </script>
    </div>
@endsection
