@extends('left')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />

<div class="container">
        <table><tr><td>
        <h3>Employees</h3></td><td>
         <a href="{{route('employee-add-form')}}"><button class="addclient-btn">+Create New</button></a></td></tr></table>

      @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
      @endif
      @if ($error = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $error }}</p>
        </div>
      @endif
        <table class="table table-bordered" id="example" style="background-color: white;border-radius:5px;">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            <?php $i=1;?>
             @foreach($employee as $emp)
            <tr>
                    {{-- @if(($res->image)=="")
                        echo '<td><image src="/image.jpg" width="70px" height="40px"></td>';
                    @else
                        echo '<td><image src='.'/'.$res->image.' width="50px" height="40px"></td>' --}}

                <td>{{$emp->first_name}}</td>
                <td>{{$emp->last_name}}</td>
                    <?php
                        $com=DB::table('companies')->select('name')->where('id',$emp->company)->first();
                    ?>
                <td>{{$com->name}}</td>
                <td>{{$emp->email}}</td>
                <td>{{$emp->phone}}</td>
                <td>
                    <a href="{{url('employees/edit/'.$emp->id)}}"><button type="submit"  class="edit-btn"><i class="fa-solid fa-pen-to-square"></i></button></a>
                    <a href="{{url('employees/delete/'.$emp->id)}}" type="button" onclick="confirmation(event)" class="delete-btn"><i class="fa-solid fa-trash-can"></i></button>
                    <a
                        href="javascript:void(0)"
                        id="show-user"
                        data-url="{{ route('employee-show', $emp->id) }}"
                        ><i class="fa-solid fa-eye view-btn"></i></a>
                </td>

                <?php $i++; ?>
            </tr>
            @endforeach


        </table>
        <div class="row">{{$employee->links()}}</div>

    </div>

<!-- Modal -->
<div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:420px;height:200px">
      <div class="modal-content">
        <div class="modal-header" style="background-color: black">
          <h5 class="modal-title" id="exampleModalLabel" style="color: white">Employee Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white"></button>
        </div>
        <div class="modal-body">
            <div><img src="{{asset('profile.png')}}" class="profile-img"></div>
            <table class="table">
              <tr><td>First Name:          </td> <td id="employee-fname"></td></tr>
              <tr><td>Last Name:          </td> <td id="employee-lname"></td></tr>
              <tr><td>Company:          </td> <td id="employee-company"></td></tr>
              <tr><td>Email Address: </td> <td id="employee-email"></td></tr>
              <tr><td>Phone Number: </td> <td id="employee-phone"></td></tr>
            </table>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> --}}
      </div>
    </div>
  </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript">

      $(document).ready(function () {

        $('body').on('click', '#show-user', function () {
          var userURL = $(this).data('url');
          $.get(userURL, function (data) {
              $('#userShowModal').modal('show');
              $('#employee-fname').text(data.first_name);
              $('#employee-lname').text(data.last_name);
              $('#employee-company').text(data.company);
              $('#employee-email').text(data.email);
              $('#employee-phone').text(data.phone);
            })
       });
    });

  </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        function confirmation(ev){
            ev.preventDefault();
            var directpath = ev.currentTarget.getAttribute('href');
            console.log(directpath);

            swal({
                title: 'Are you sure want to delete this client?',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel)=>{
                if(willCancel){
                    window.location.href = directpath;
                }
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



@endsection
