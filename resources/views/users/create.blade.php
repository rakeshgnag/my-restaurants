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
          <li class="breadcrumb-item"><a href="/restaurants.list">Manage Users</a></li>
          <li class="breadcrumb-item active" aria-current="page">Create User </li>
        </ol>
      </nav>

      <div class="border p-4">
        <form method="post" action="/users.store"  enctype="multipart/form-data">
          @csrf

          <div class="form-group form-row" >
            <label for="name" class="col-sm-1">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control col-sm-8" name="name" id="name" aria-describedby="name" placeholder="Enter Name" value="{{ old('name') }}" required maxlength="100">
          </div>


          <div class="form-group form-row" >
            <label for="email" class="col-sm-1">Email <span class="text-danger">*</span></label>
             <input type="text" class="form-control col-sm-8" name="email" id="name" aria-describedby="name" placeholder="Enter Email" value="{{ old('email') }}" required maxlength="100">
          </div>

          <div class="form-group form-row" >
            <label for="password" class="col-sm-1">Password <span class="text-danger">*</span></label>
            <input type="password" required class="form-control col-sm-8" id="Password" name="password">
          </div>


          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection


