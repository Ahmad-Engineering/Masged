@extends('admin.parent')

@section('title', 'Admin')

@section('capital-title', 'Update Admin')
@section('home-title', 'Home')
@section('small-title', 'admin-profiled-info')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update info</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create-form">
                @csrf
              <div class="card-body">
                <div class="card-body">
                  <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" class="form-control" id="first_name" placeholder="Enter first name"
                    value="{{$user->first_name}}">
                  </div>
                  <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" class="form-control" id="last_name" placeholder="Enter last name"
                    value="{{$user->last_name}}">
                  </div>
                  <div class="form-group">
                      <label for="email">E-mail</label>
                      <input type="email" class="form-control" id="email" placeholder="Enter your E-mail"
                      value="{{$user->email}}">
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" class="form-control" id="phone" placeholder="Enter your phone"
                    value="{{$user->phone}}">
                  </div>
                  <div class="form-group">
                    <label for="age">age</label>
                    <input type="number" class="form-control" id="age" placeholder="Enter your age"
                    value="{{$user->age}}">
                  </div>
                {{-- THERE ARE SOME WORK IN GENEDER IN ANOTHER UPDATE --}}
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="updateAdminProfile()" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

{{-- @section('scripts')
    <script>
        function store () {
          // masged/admin/teacher
          // Make a request for a user with a given ID
          axios.psot('/masged/admin/teacher'
          , 
          [
            name: document.getElementById('first_name').value,
          ]
          )
              .then(function (response) {
                  // handle success
                  console.log(response);
              })
              .catch(function (error) {
                  // handle error
                  console.log(error);
              })
              .then(function () {
                  // always executed
              });
        }
    </script>
@endsection --}}

@section('scripts')
    <script>
      function updateAdminProfile () {
        // alert('Sure');
        axios.put('/masged/manager/edit-profile/' , {
          first_name: document.getElementById('first_name').value,
          last_name: document.getElementById('last_name').value,
          email: document.getElementById('email').value,
          phone: document.getElementById('phone').value,
          age: document.getElementById('age').value,
        })
          .then(function (response) {
            // handle success
            toastr.success(response.data.message);
            // document.getElementById('create-form').reset();
          })
          .catch(function (error) {
            // handle error
            toastr.error(error.response.data.message)
          })
          .then(function () {
            // always executed
          });
      }
    </script>
@endsection

