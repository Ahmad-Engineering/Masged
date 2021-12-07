@extends('admin.parent')

@section('title', 'Teachers')

@section('capital-title', 'Create teacher')
@section('home-title', 'Home')
@section('small-title', 'teachers')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create teacher</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create-form">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="first_name">First name</label>
                  <input type="text" class="form-control" id="first_name" placeholder="Enter first name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" class="form-control" id="last_name" placeholder="Enter last name">
                </div>
                <div class="form-group">
                    <label for="email">E-mail 'Optional'</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter E-mail">
                </div>
                <div class="form-group">
                    <label for="phone">Phone 'Required'</label>
                    <input type="number" class="form-control" id="phone" placeholder="Enter phone">
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" id="age" placeholder="Enter phone">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="active" checked>
                      <label class="custom-control-label" for="active">Active</label>
                    </div>
                </div>
                {{-- THERE ARE SOME WORK IN GENEDER IN ANOTHER UPDATE --}}
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="store()" class="btn btn-primary">Submit</button>
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
      function store () {
        // alert('Sure');
        axios.post('/masged/manager/teacher', {
          first_name: document.getElementById('first_name').value,
          last_name: document.getElementById('last_name').value,
          email: document.getElementById('email').value,
          phone: document.getElementById('phone').value,
          age: document.getElementById('age').value,
          active: document.getElementById('active').checked
        })
          .then(function (response) {
            // handle success
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-form').reset();
          })
          .catch(function (error) {
            // handle error
            console.log(error);
            toastr.error(error.response.data.message)
          })
          .then(function () {
            // always executed
          });
      }
    </script>
@endsection

