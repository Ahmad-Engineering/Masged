
@extends('admin.parent')

@section('title', 'Student Courses')

@section('capital-title', 'Students Courses')
@section('home-title', 'Home')
@section('small-title', 'student-courses')

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
                <h3 class="card-title">Students Courses</h3>

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
                      {{-- <th>Masged name</th> --}}
                      <th>Name</th>
                      <th>Status</th>
                      <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>

                    {{-- BODY  --}}

                    @foreach ($students as $student)
                      @foreach ($student->courses as $course)
                      <tr>
                        <td>{{$student->id}}</td>
                        <td>{{$student->first_name . ' ' . $student->last_name}}</td>
                        <td>@if($student->status) <span class="badge bg-success">Active</span>
                          @else
                          <span class="badge bg-danger">Disabled</span>
                          @endif
                        </td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-danger" onclick="removeStudentFromCourse({{$course->id}}, this)">
                              <i class="fas fa-trash"></i>
                            </button>
                          </div>
                        </td>

                        {{-- <td><span class="tag tag-success">Approved</span></td> --}}
                        {{-- <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td> --}}
                      </tr>
                      @endforeach
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
      function removeStudentFromCourse (id, refranec) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            destroy(id, refranec);
          }
        });
      }

      function destroy (id, refranec) {
        // masged/manager/student-course/{student_course}
        axios.delete('/masged/manager/student-course/' + id)
          .then(function (response) {
            // handle success
            console.log(response);
            refranec.closest('tr').remove();
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
          timer: 2000
        });
      }
    </script>
@endsection