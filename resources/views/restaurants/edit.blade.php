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
          <li class="breadcrumb-item"><a href="/restaurants.list">Manage Restaurant</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Restaurant </li>
        </ol>
      </nav>

      <div class="border p-4">
        <form method="post" action="/restaurants.update"  enctype="multipart/form-data">
          @csrf
          @include('common.errors') 

          <input type="hidden" name="id" value="{{$restaurant->id}}">

          <div class="form-group form-row" >
            <label for="name" class="col-sm-1">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control col-sm-8" name="name" id="name" aria-describedby="name" placeholder="Enter Event Title" value="{{ $restaurant->name }}" required maxlength="100">
          </div>


          <div class="form-group form-row" >
            <label for="description" class="col-sm-2">Description <span class="text-danger">*</span></label>
            <textarea class="form-control" required class="form-control col-sm-6" name="description" rows="5" id="comment">{{ $restaurant->description }}</textarea>
          </div>

          <div class="form-group form-row" >
            <label for="lat" class="col-sm-1">Latitude <span class="text-danger">*</span></label>
            <input type="text" name="lat" required value="{{ $restaurant->lat }}">
          </div>

          <div class="form-group form-row" >
            <label for="long" class="col-sm-1">Longitude <span class="text-danger">*</span></label>
            <input type="text" name="lon" required value="{{ $restaurant->lon }}">
          </div>


          <div class="form-group">
           <p>Previous Image : </p><img src="/storage/images/restaurants/{{$restaurant->image}}" class="img-fluid" alt="Responsive image" width="80" height="80">
           <br />
           <label for="image"> Banner Image <span class="text-danger">*</span></label>
            <input type="file" name="banner"><br>
            <small>max file size: 5MB</small>
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection


