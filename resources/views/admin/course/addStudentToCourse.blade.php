
@extends('admin.parent')

@section('title', 'Submit Course')

@section('capital-title', 'Submit Course')
@section('home-title', 'Home')
@section('small-title', 'students')


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
                  {{-- {{
                      $masged = Masged::where('manager_id', auth()->user()->id)->first();
                      $reCourse = Course::where('masged_name', $masged->name)->where('id', $student->id)->first();
                  }} --}}

                    <h3 class="card-title">{{$course->name}}</h3>

                    {{-- @foreach ($students as $student)
                        <h3 class="card-title">{{$student->first_name}}</h3>
                    @endforeach --}}


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
                      <th>email</th>
                      <th>Status</th>
                      <th>Craeted at</th>
                      <th>Updated at</th>
                      <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($students as $student)
                    <tr> 
                      <td>{{$student->id}}</td>
                      <td>{{$student->first_name . ' ' . $student->last_name}}</td>
                      <td>{{$student->email}}</td>
                      <td>
                        @if($student->status)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Diabled</span>
                        @endif
                      </td>
                      {{-- <td>{{$student->phone}}</td> --}}
                      <td>{{$student->created_at}}</td>
                      <td>{{$student->updated_at}}</td>
                      <td>
                        {{-- <div class="btn-group">
                          <a href="#" class="btn btn-success">
                            <i class="fas fa-check-circle"></i>
                          </a>
                        </div> --}}

                        {{-- <div class="btn-group">
                          <a href="{{route('add.student', $student->id)}}" class="btn btn-success">
                            <i class="fas fa-address-card"></i>
                          </a>
                        </div> --}}

                        <div class="btn-group">
                          <button type="button" class="btn btn-info" onclick="addStudentToCourse({{$course->id}}, {{$student->id}})">
                            <i class="fas fa-check-circle"></i>
                          </button>
                        </div>
                      </td>

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
      function addStudentToCourse(courseId, studentId) {
        Swal.fire({
          title: 'Are you sure?',
          text: "This student will take this course",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, add it!'
        }).then((result) => {
          if (result.isConfirmed) {
            adding(courseId, studentId);
          }
        });
      }

      function adding (courseId, studentId) {
        // masged/manager/{course}/addcourse/{student}
        axios.post('/masged/manager/' + courseId + '/addstudent/' + studentId + '/')
          .then(function (response) {
            // handle success
            console.log(response);
            // refranec.closest('tr').remove();
            showDeletingResult(response.data);
          })
          .catch(function (error) {
            // handle error
            console.log(error);
            showDeletingResult(error.response.data);
          })
          .then(function () {
            // always executed
          });
      }

      function showDeletingResult (data) {
        Swal.fire({
          icon: data.icon,
          title: data.title,
          text: data.text,
          showConfirmButton: false,
          timer: 4000
        });
      }
    </script>
@endsection