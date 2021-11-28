@extends('admin.parent')

@section('title', 'Mosque')

@section('capital-title', 'Update mosque')
@section('home-title', 'Home')
@section('small-title', 'mosques')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update mosque</h3>
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
                    value="{{$masged->name}}">
                  </div>
                  <div class="form-group">
                      <label for="info">Information 'optional'</label>
                      <input type="text" class="form-control" id="info" placeholder="Enter some information about your mosque"
                      value="{{$masged->info}}">
                  </div>
                  <div class="form-group">
                      <label for="location">Location</label>
                      <input type="text" class="form-control" id="location" placeholder="Enter mosque location"
                      value="{{$masged->location}}">
                  </div>
                {{-- THERE ARE SOME WORK IN GENEDER IN ANOTHER UPDATE --}}
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="update({{$masged->id}})" class="btn btn-primary">Submit</button>
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
        axios.put('/masged/admin/masged/' + id, {
          name: document.getElementById('name').value,
          info: document.getElementById('info').value,
          location: document.getElementById('location').value
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

