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
          <li class="breadcrumb-item">Manage Users</li>
        </ol>
      </nav>

      <a href="/users.create" class="btn btn-primary btn-sm">Create User</a>
      <br /><br />

      <div class="border p-4">
        <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col" colspan="2">Options</th>
          </tr>
        </thead>
        <tbody>

          @foreach($users as $user)
          <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
             <td><a href="/users.edit?user_id={{$user->id}}">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
            </td>
            <td>
                <form method="post" action="/users.delete"  enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{$user->id}}">
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
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


