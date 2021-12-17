
@extends('admin.parent')

@section('title', 'Students')

@section('capital-title', 'Students to add')
@section('home-title', 'students')
@section('small-title', 'student-students')

@section('style')
    
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Students</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      {{-- <th>Info</th> --}}
                      {{-- <th>Status</th> --}}
                      {{-- <th>Craeted at</th> --}}
                      {{-- <th>Updated at</th> --}}
                      <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($students as $student)
                    <tr>
                      <td>{{$student->id}}</td>
                      <td>{{$student->first_name . ' ' . $student->last_name}}</td>


                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-warning" onclick="store({{$student->id}}, {{$circleId}})">
                            <i class="">Submit</i>
                          </button>
                        </div>
                      </td>

                      {{-- THIS IS THE CIRCLE SETTINGS --}}
                      {{-- <td>
                        <div class="btn-group">
                          <a href="{{route('student.edit', $student->id)}}" class="btn btn-info">
                            <i class="fas fa-edit"></i>
                          </a>
                        </div>

                        <div class="btn-group">
                          <a href="{{route('add.student', $student->id)}}" class="btn btn-info">
                            <i class="fas fa-address-card"></i>
                          </a>
                        </div>

                        <div class="btn-group">
                          <a href="{{route('add.student', $student->id)}}" class="btn btn-success">
                            <i class="fas fa-address-card"></i>
                          </a>
                        </div>

                        <div class="btn-group">
                          <button type="button" class="btn btn-danger" onclick="confirmDestroy({{$student->id}}, this)">
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </td> --}}

                      {{-- <td><span class="tag tag-success">Approved</span></td> --}}
                      {{-- <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td> --}}
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
      function store (studentId, circleId) {
        // alert('Sure');
        // masged/manager/add-student-to-circle/submit
        axios.post('/masged/manager/add-student-to-circle/submit/', {
          studentId: studentId,
          circleId: circleId
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