@extends('admin.parent')

@section('title', 'Change Password')

@section('capital-title', 'Change Password')
@section('home-title', 'Password')
@section('small-title', 'change-password')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Change Password</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create-form">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="current_password">Current Password</label>
                  <input type="password" class="form-control" id="current_password" placeholder="Enter Current Password">
                </div>
                <div class="form-group">
                  <label for="new_password">New Password</label>
                  <input type="password" class="form-control" id="new_password" placeholder="Enter New Password">
                </div>
                <div class="form-group">
                  <label for="new_password_confirmation">Re-new Password</label>
                  <input type="password" class="form-control" id="new_password_confirmation" placeholder="Re-enter New Password">
                </div>
                {{-- THERE ARE SOME WORK IN GENEDER IN ANOTHER UPDATE --}}
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="updatePassword()" class="btn btn-primary">Submit</button>
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


@section('scripts')
    <script>
      function updatePassword () {
        // alert('Sure');
        axios.put('/masged/manager/edit-password', {
          current_password: document.getElementById('current_password').value,
          new_password: document.getElementById('new_password').value,
          new_password_confirmation: document.getElementById('new_password_confirmation').value,
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

