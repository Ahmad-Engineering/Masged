@extends('admin.parent')

@section('title', 'Mosque')

@section('capital-title', 'Create mosque')
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
              <h3 class="card-title">Create mosque</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create-form">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="info">Information 'optional'</label>
                    <input type="text" class="form-control" id="info" placeholder="Enter some information about your mosque">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" placeholder="Enter mosque location">
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


@section('scripts')
    <script>
      function store () {
        // alert('Sure');
        axios.post('/masged/manager/masged', {
          name: document.getElementById('name').value,
          info: document.getElementById('info').value,
          location: document.getElementById('location').value,
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

