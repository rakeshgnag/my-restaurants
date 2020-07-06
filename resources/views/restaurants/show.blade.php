@extends('layouts.app')
@section('content')
<div class="container">
  <nav aria-label="breadcrumb">
     @if ( Auth::user()->type == "admin")
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/restaurants.list">Manage Restaurants</a></li>
      </ol>
      @else
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
      </ol>
      @endif

  </nav>
  <div class="row">
    <div class="col-md-8">
    <img src="/storage/images/restaurants/{{$restaurant->image}}" class="img-fluid" alt="Responsive image">
    <div class="card">
      <div class="card-head">
        <h2>{{$restaurant->name}}</h2>
      </div>
      <div class="card-body">
        {{$restaurant->description}}
      </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title"> {{$restaurant->name}} </h5>
          <p class="card-text">Be the first to get notified. Pay now to get more benefits.</p>
          <form method="post" action="/order.store"  enctype="multipart/form-data">
            @csrf
            @include('common.errors')
            <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <button type="submit" class="btn btn-primary">Pay Now</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


