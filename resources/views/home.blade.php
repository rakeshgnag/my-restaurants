@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search Restaurants</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($errors->any())
                     <div class="alert alert-warning" role="alert">
                        <h4>{{$errors->first()}}</h4>
                     </div>
                    @endif
                    <form method="post" action="/restaurants.search"  enctype="multipart/form-data">
                     @csrf    
                      <div class="form-group form-row" >
                        <label for="name" class="col-sm-3">Enter Your Location <span class="text-danger">*</span></label>
                        <select class="js-example-basic-single form-control col-sm-8" name="location">
                          <option value="HSR">HSR Layout</option>
                          <option value="ELE">Electronic City</option>
                          <option value="BTM">BTM Layout</option>
                          <option value="WF">White Field</option>
                        </select>
                        <center>
                            <small>
                                <span>Searches restaurants within radius of 4 kms</span>
                            </small>
                        </center>
                      </div>
                        
                      <center>
                          <button type="submit" class="btn btn-secondary">Search</button>
                      </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endsection
