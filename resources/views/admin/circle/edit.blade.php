@extends('admin.parent')

@section('title', 'Circles')

@section('capital-title', 'Update circle')
@section('home-title', 'Circles')
@section('small-title', 'student-circle')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update circle</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create-form">
                @csrf
              <div class="card-body">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name"
                    value="{{$circle->name}}">
                  </div>
                  <div class="form-group">
                      <label for="info">Information 'optional'</label>
                      <input type="text" class="form-control" id="info" placeholder="Enter some information about your circle"
                      value="{{$circle->info}}">
                  </div>

                  {{-- THIS IS THE STATUS CIRCLE --}}
                  {{-- <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="active" @if($circle->status) checked @endif>
                      <label class="custom-control-label" for="active">Active</label>
                    </div>
                  </div> --}}

                {{-- THERE ARE SOME WORK IN GENEDER IN ANOTHER UPDATE --}}
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="update({{$circle->id}})" class="btn btn-primary">Submit</button>
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
      function update (id) {
        // alert('Sure');
        axios.put('/masged/manager/circle/' + id, {
          name: document.getElementById('name').value,
          info: document.getElementById('info').value,
          // status: document.getElementById('active').checked
        })
          .then(function (response) {
            // handle success
            console.log(response);
            toastr.success(response.data.message);
            // document.getElementById('create-form').reset();
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

