
@extends('admin.parent')

@section('title', 'Course mark')

@section('capital-title', 'Course mark')
@section('home-title', 'Course marks')
@section('small-title', 'marks-marks')

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
                <h3 class="card-title">Courses marks</h3>

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
                      <th>Student name</th>
                      <th>Course name</th>
                      <th>Marks</th>
                      <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($marks as $mark)
                    <tr>
                      <td>{{$mark->id}}</td>
                      <td>{{$mark->student->first_name . ' ' . $mark->student->last_name}}</td>
                      <td>{{$mark->course_name}}</td>
                      <td>{{$mark->marks}}</td>
                      <td>
                        <div class="btn-group">
                          <a href="{{route('give.mark.from.admin', [$mark->course_id, $mark->student_id])}}" class="btn btn-warning">
                            <i class="">Edit mark</i>
                          </a>
                        </div>
                      </td>
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