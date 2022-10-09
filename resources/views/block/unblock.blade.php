@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Home',
            'link' => '/home',
            'active' => false,
        ],
        [
            'label' => 'Unblock User',
            'link' => '#',
            'active' => true
        ],
    ]"/>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Profile
    </div>
    <div class="card-body mt-2">
        <div class="d-flex justify-content-center">
            @if ($profile->avatar)
                <img class="rounded-circle img-thumbnail object-fit-cover profile-avatar-size"src="{{ asset('storage/'.$profile->avatar) }}" alt="">
            @else
                <div class="no-profile-image">
                    No Profile image
                </div>
            @endif
        </div>
        <div class="text-center mt-2">
            <div style="font-size: 18px; text-transform: uppercase; letter-spacing: 0.25em">
                {{$user->name}}
            </div>
            <div>
                <small class="text-secondary">
                    {{$user->email}} |  @if ($profile->phone) {{$profile->phone}} @else No Phone Number @endif
                </small>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <form id="unblocking">
                @csrf
                <input type="hidden" id="blocked_id" name="blocked_id" value="{{$user->id}}">
                <div class="mt-2 form-group" style="text-align:center !important;">
                    <button type="submit" id="unblockingbtn" class="btn btn-primary">
                        Unblock User
                    </button>
                </div>  
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/unblock.js') }}"></script>
@endsection
