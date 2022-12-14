@extends('layouts.guest')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card-group d-block d-md-flex row">
        <div class="card col-md-7 p-4 mb-0">
          <form class="card-body" action="/login" method="POST">
            @csrf
            <h1>Login</h1>
            <p class="text-medium-emphasis">Sign In to your account</p>
            <div class="input-group mb-3"><span class="input-group-text">
                <svg class="icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                </svg></span>
              <input class="form-control" type="text" name="email" placeholder="Username">
            </div>
            <div class="input-group mb-4"><span class="input-group-text">
                <svg class="icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                </svg></span>
              <input class="form-control" name="password" type="password" placeholder="Password">
            </div>
            <div class="row">
              <div class="col-6">
                <button class="btn btn-primary px-4" type="submit">Login</button>
              </div>
              <div class="col-6 text-end">
                <a class="btn btn-link px-0" href="{{route('password.request')}}">Forgot password?</a>
              </div>
            </div>
          </form>
        </div>
        <div class="card col-md-5 text-white bg-primary py-5">
          <div class="card-body text-center">
            <div>
              <h2>Sign up</h2>
              <p>Explore our app.</p>
              <a class="btn btn-lg btn-outline-light mt-3" href="/register">Register Now!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
