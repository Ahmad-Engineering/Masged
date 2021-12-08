
@extends('admin.parent')

@section('title', 'Submit Course')

@section('capital-title', 'Submit Course')
@section('home-title', 'Home')
@section('small-title', 'teachers')


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
                      $reCourse = Course::where('masged_name', $masged->name)->where('id', $teacher->id)->first();
                  }} --}}

                    @foreach ($course as $reCourse)
                        <h3 class="card-title">{{$reCourse->name}}</h3>
                    @endforeach

                    {{-- @foreach ($teachers as $teacher)
                        <h3 class="card-title">{{$teacher->first_name}}</h3>
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
                      <th>Info</th>
                      <th>Status</th>
                      <th>Craeted at</th>
                      <th>Updated at</th>
                      <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($teachers as $teacher)
                    <tr> 
                      <td>{{$teacher->id}}</td>
                      <td>{{$teacher->first_name . ' ' . $teacher->last_name}}</td>
                      <td>{{$teacher->email}}</td>
                      {{-- <td>
                        @if($teacher->status)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Diabled</span>
                        @endif
                      </td> --}}
                      <td>{{$teacher->phone}}</td>
                      <td>{{$teacher->created_at}}</td>
                      <td>{{$teacher->updated_at}}</td>
                      <td>
                        {{-- <div class="btn-group">
                          <a href="#" class="btn btn-success">
                            <i class="fas fa-check-circle"></i>
                          </a>
                        </div> --}}

                        {{-- <div class="btn-group">
                          <a href="{{route('add.teacher', $teacher->id)}}" class="btn btn-success">
                            <i class="fas fa-address-card"></i>
                          </a>
                        </div> --}}

                        <div class="btn-group">
                          <button type="button" class="btn btn-info" onclick="addCourse({{$reCourse->id}}, {{$teacher->id}})">
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
      function addCourse(courseId, teacherId) {
        Swal.fire({
          title: 'Are you sure?',
          text: "This teacher will take this course",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, add it!'
        }).then((result) => {
          if (result.isConfirmed) {
            adding(courseId, teacherId);
          }
        });
      }

      function adding (courseId, teacherId) {
        // masged/manager/{course}/addcourse/{teacher}
        axios.post('/masged/manager/' + courseId + '/addcourse/' + teacherId + '/')
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