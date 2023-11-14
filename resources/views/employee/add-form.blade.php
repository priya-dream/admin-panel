@extends('left')
@section('content')

<a href="/employees"><button class="back-btn"><-BACK</button></a>
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
    <h3>Create new Employee</h3></br>
    <form action="{{route('employee-create')}}" method="POST" enctype="multipart/form-data" class="add-form">
        {{csrf_field()}}
            <div class="col-8">
                First Name <span style="color:red">*</span>
                <input type="text" name="fname" class="form-control" required>
            </div></br>
            <div class="col-8">
                Last Name <span style="color:red">*</span>
                  <input type="text" name="lname" class="form-control" required>
            </div></br>
            <div class="col-8">
                Company <span style="color:red">*</span>
                <select name = "company" class="form-control">
                    <option>Select..</option>
                    @foreach ($company as $com)
                    <option>{{$com->name}}</option>
                    @endforeach
                </select>

                  {{-- <input type="text" name="lname" class="form-control" required> --}}
            </div></br>
            <div class="col-8">
                Email Address <span style="color:red">*</span>
              <input type="email" name="email" class="form-control" required>
            </div></br>
            <div class="col-8">
                Phone <span style="color:red">*</span>
                  <input type="tel" name="phone" class="form-control" placeholder="7777777777" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>
            </div></br>
        <input type="submit" class="addbtn" value="ADD" style="margin-bottom: 20px"></br>
      </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@endsection
