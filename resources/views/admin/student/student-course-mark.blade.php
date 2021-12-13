
@extends('admin.parent')

@section('title', 'Students mark')

@section('capital-title', 'Students mark')
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
                <h3 class="card-title">Students Marks</h3>

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
                            <a href="#" class="btn btn-warning">
                              <i class="">Add mark</i>
                            </a>
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
