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
     @if($errors->any())
       <div class="alert alert-success" role="alert">
          <h4>{{$errors->first()}}</h4>
       </div>
      @endif
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
    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
      <div class="card-header">Successfully Paid</div>
      <div class="card-body">
        <h5 class="card-title">{{$restaurant->name}}</h5>
        <p class="card-text">Thank you for your interest. Please check your mail for confirmation</p>
      </div>
    </div>
    </div>
  </div>
</div>
@endsection


