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
                  <input type="text" class="form-control" id="name" placeholder="Enter name"
                  value="{{$student->first_name . ' ' . $student->last_name}}">
                </div>
                <div class="form-group">
                    <label for="part_no">Part no.</label>
                    <input type="text" class="form-control" id="part_no" placeholder="Part number">
                </div>
                <div class="form-group">
                  <label for="from_page">From page</label>
                  <input type="text" class="form-control" id="from_page" placeholder="From page">
                </div>
                <div class="form-group">
                  <label for="to_page">To page</label>
                  <input type="text" class="form-control" id="to_page" placeholder="To page">
                </div>
                <div class="form-group">
                    <label for="circle_no">Circle no.</label>
                    <input type="text" class="form-control" id="circle_no" readonly
                    value="{{$circle->name}}">
                </div>
                {{-- THERE ARE SOME WORK IN GENEDER IN ANOTHER UPDATE --}}
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="store({{$circle->id}}, {{$student->id}})" class="btn btn-primary">Submit</button>
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
      function store (circleId, studentId) {
        // alert('Sure');
        axios.post('/masged/manager/circle-brows/circle/add', {
          part_no: document.getElementById('part_no').value,
          from_page: document.getElementById('from_page').value,
          to_page: document.getElementById('to_page').value,
          circleId: circleId,
          studentId: studentId,
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

