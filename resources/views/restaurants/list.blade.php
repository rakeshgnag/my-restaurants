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
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/restaurants.list">Manage Restaurants</a></li>
        </ol>
      </nav>

      <a href="/restaurant.create" class="btn btn-primary btn-sm">Create Restaurant</a>
      <br /><br />

      <div class="border p-4">
        <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col" colspan="2">Options</th>
          </tr>
        </thead>
        <tbody>

          @foreach($restaurants as $restaurant)
          <tr>
            <th scope="row">{{$restaurant->id}}</th>
            <td> <img src="/storage/images/restaurants/{{$restaurant->image}}" class="img-fluid" alt="Responsive image" width="80" height="80"> </td>
            <td>{{$restaurant->name}}</td>
            <td><a href="/restaurant.edit?restaurant_id={{$restaurant->id}}">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
            </td>
            <td><a href="/restaurant.show?restaurant_id={{$restaurant->id}}">
                <i class="fa fa-info" aria-hidden="true"></i>
                </a>
            </td>
          </tr>
          @endforeach
         
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection


