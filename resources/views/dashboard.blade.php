@extends('layouts.app')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        </ol>
      </nav>
    <div class="row justify-content-center">
        <!--
        @if (session('status'))
                <div class="alert alert-success" role="alert">
                </div>
            @endif
        -->
        
        <div class="col-sm-4">
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                
                <h5 class="card-title">Manage Restaurants <i class="fa fa-building" aria-hidden="true"></i></h5>
                <small class="card-text">Add, Update, Remove restaurant from this panel.</small>
                <br />
                <a href="/restaurants.list" class="btn btn-primary btn-sm">Details</a>
              </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">Manage Orders <i class="fa fa-envelope-open" aria-hidden="true"></i></h5>
                
                <small class="card-text">Add, Update, Remove orders from this panel.</small>
                <br /><br />
                <a href="/orders.list" class="btn btn-primary btn-sm">Details</a>
              </div>
            </div>
        </div>

         <div class="col-sm-4">
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">Manage User <i class="fa fa-user" aria-hidden="true"></i></h5>
                <small class="card-text">Add, Update, Remove users from this panel.</small><br /><br />
                <a href="/users.list" class="btn btn-primary btn-sm">Details</a>
              </div>
            </div>
        </div>

    </div>
</div>
@endsection
