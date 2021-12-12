
@extends('admin.parent')

@section('title', 'All Courses')

@section('capital-title', 'Courses')
@section('home-title', 'courses')
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
                <h3 class="card-title">Courses</h3>

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

                    @foreach ($courses as $course)
                      <tr>
                        <td>{{$course->id}}</td>
                        <td>{{$course->name}}</td>
                        <td>@if($course->status) <span class="badge bg-success">Active</span>
                          @else
                          <span class="badge bg-danger">Disabled</span>
                          @endif
                        </td>
                        <td>
                          <div class="btn-group">
                            <a href="{{route('student-course.show', $course->id)}}" class="btn btn-info">
                              <i class="fab fa-get-pocket"></i>
                            </a>
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