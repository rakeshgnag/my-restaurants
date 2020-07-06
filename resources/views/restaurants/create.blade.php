@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <!-- Display Validation Errors -->
      @include('common.errors') 
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/restaurants.list">Manage Restaurant</a></li>
          <li class="breadcrumb-item active" aria-current="page">Create Restaurant </li>
        </ol>
      </nav>

      <div class="border p-4">
        <form method="post" action="/restaurant.store"  enctype="multipart/form-data">
          @csrf

          <div class="form-group form-row" >
            <label for="name" class="col-sm-1">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control col-sm-8" name="name" id="name" aria-describedby="name" placeholder="Enter Restaurant Name" value="{{ old('name') }}" required maxlength="100">
          </div>


          <div class="form-group form-row" >
            <label for="description" class="col-sm-1">Description <span class="text-danger">*</span></label>
            <textarea class="form-control" required name="description" rows="5" id="comment"></textarea>
          </div>

          <div class="form-group form-row" >
            <label for="starts_at" class="col-sm-1">Latitude <span class="text-danger">*</span></label>
            <input type="text" required class="form-control col-sm-8" name="lat" value="{{ old('lat') }}" required maxlength="10">
          </div>

          <div class="form-group form-row" >
            <label for="ends_at" class="col-sm-1">Longitude <span class="text-danger">*</span></label>
            <input type="text" required class="form-control col-sm-8" name="lon" value="{{ old('lon') }}" required maxlength="10">
          </div>

          <div class="form-group">
           <label for="image"> Banner Image<span class="text-danger">*</span></label>
            <input type="file" name="banner"><br>
            <small>max file size: 5MB</small>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection


