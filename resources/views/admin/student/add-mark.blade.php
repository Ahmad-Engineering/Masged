@extends('admin.parent')

@section('title', 'Students mark')

@section('capital-title', 'Student Marks')
@section('home-title', 'Home')
@section('small-title', 'student-marks')

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
                <h3 class="card-title">
                  {{
                    $student->first_name . ' ' . $student->last_name
                  }}
                </h3>

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
                <form id="create-form">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="first_name">First name</label>
                      <input type="text" class="form-control" id="first_name" placeholder="Enter first name"
                      value="{{$student->first_name}}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name</label>
                        <input type="text" class="form-control" id="last_name" placeholder="Enter last name"
                        value="{{$student->last_name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail 'Optional'</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter E-mail"
                        value="{{$student->email}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone 'Optional'</label>
                        <input type="text" class="form-control" id="phone" placeholder="Enter phone"
                        value="{{$student->phone}}">
                    </div>
                    <div class="form-group">
                      <label for="parent_phone">Parent phone 'Required'</label>
                      <input type="text" class="form-control" id="parent_phone" placeholder="Enter parent phone"
                      value="{{$student->parent_phone}}">
                  </div>
                  <div class="form-group">
                      <label for="age">Age</label>
                      <input type="number" class="form-control" id="age" placeholder="Enter phone"
                      value="{{$student->age}}">
                  </div>
                  <div class="form-group">
                    <label>Gender</label>
                    <div class="form-check">
                      <input class="form-check-input" id="male" type="radio" name="gender" value="male" @if($student->gender == 'Male') checked @endif>
                      <label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" id="female" type="radio" name="gender" value="female" @if($student->gender == 'Female') checked @endif>
                      <label class="form-check-label">Female</label>
                    </div>
                    {{-- <div class="form-check">
                      <input class="form-check-input" type="radio" disabled="">
                      <label class="form-check-label">Radio disabled</label>
                    </div> --}}
                  </div>
                  <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="active" @if($student->status) checked @endif>
                        <label class="custom-control-label" for="active">Active</label>
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="mark">Mark</label>
                    <input type="number" class="form-control" id="mark" placeholder="Enter student mark">
                  </div>
                    {{-- THERE ARE SOME WORK IN GENEDER IN ANOTHER UPDATE --}}
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="button" onclick="setMark({{$course->id}}, {{$student->id}})" class="btn btn-primary">Submit</button>
                  </div>
                </form>
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
      function setMark (course_id, student_id) {
        // /show-student-mark/{course_id}/course/{student_id}/student/submit-mark
        // /show-student-mark/{course_id}/course/{student_id}/student/submit-mark
        axios.post('/masged/manager/show-student-mark/submit-mark', {
          mark: document.getElementById('mark').value,
          course_id: course_id,
          student_id: student_id
        })
          .then(function (response) {
            // handle success
            // console.log(response);
            toastr.success(response.data.message);
            // document.getElementById('create-form').reset();
          })
          .catch(function (error) {
            // handle error
            // console.log(error);
            toastr.error(error.response.data.message)
          })
          .then(function () {
            // always executed
          });
      }
    </script>
@endsection