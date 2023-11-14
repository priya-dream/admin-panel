@extends('left')
@section('content')

<a href="/companies"><button class="back-btn"><-BACK</button></a>
<div class="container add-form-bg" >
        @if ($message = Session::get('success'))
        <div class="alert alert-success" ">
            <p>{{ $message }}</p>
        </div>
      @endif
      @if ($error = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $error }}</p>
        </div>
      @endif</br>
    <h3>Edit company details</h3></br>
    <form action="{{url('/companies/update/'.$company->id)}}" method="POST" class="add-form">
        {{csrf_field()}}
            <div class="col-8">
                Name <span style="color:red">*</span>
                <input type="text" name="name" value={{$company->name}} class="form-control" required>
            </div></br>
            <div class="col-8">
                Email Address <span style="color:red">*</span>
              <input type="email" name="email" value={{$company->email}} class="form-control" required>
            </div></br>
            <div class="col-8">
                Logo <span style="color:red">*</span>
                  <input type="file" name="logo" value={{$company->logo}} class="form-control" required>
            </div></br>
            <div class="col-8">
                Website <span style="color:red">*</span>
                  <input type="text" name="website" value={{$company->website}} class="form-control" required>
            </div></br>
        <input type="submit" class="addbtn" value="UPDATE" style="margin-bottom: 20px"></br>
      </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@endsection
