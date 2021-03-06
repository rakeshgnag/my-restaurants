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
          <li class="breadcrumb-item"><a href="/orders.list">Manage Orders</a></li>
        </ol>
      </nav>

      

      <div class="border p-4">
        <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">User Name</th>
          </tr>
        </thead>
        <tbody>

          @foreach($users as $user)
          <tr>
            <th scope="row">{{$user->userId}}</th>
            <td><a href="/order.details?user_id={{$user->userId}}"> {{ $user->name }}</a> </td>
          </tr>
          @endforeach
         
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection


