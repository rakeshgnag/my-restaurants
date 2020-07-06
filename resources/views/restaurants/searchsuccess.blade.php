@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
       <!-- Display Validation Errors -->
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Search Results</li>
        </ol>
      </nav>

      

      <div class="border p-4">
          @foreach($restaurants as $restaurant)
            <div class="card">
                <div class="card-header">Restaurant Id # {{$restaurant->id}}</div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-sm-3">
                           <img src="/storage/images/restaurants/{{$restaurant->image}}" class="img-fluid" alt="Responsive image" width="100" height="100">
                      </div>
                      <div class="col-sm-9">
                          <p>{{ $restaurant->name }}</p>
                          <small>{{ $restaurant->description }}</small>
                      </div>
                  </div>
                </div>
                <div class="card-footer"  align="right" class="text-right">
                  <a href="/restaurant.details?restaurant_id={{$restaurant->id}}" class="btn btn-primary btn-sm">Restaurant Details</a></div>
              </div>
              <br />
          @endforeach
      </div>
    </div>
  </div>
</div>
@endsection


