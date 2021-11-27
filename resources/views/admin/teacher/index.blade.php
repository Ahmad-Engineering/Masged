
@extends('admin.parent')

@section('title', 'Teachers')

@section('capital-title', 'The Teachers')
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
                <h3 class="card-title">Teachers</h3>

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
                      <th>phone</th>
                      <th>E-mail</th>
                      <th>Age</th>
                      <th>status</th>
                      <th>Gender</th>
                      {{-- <th>Created at</th> --}}
                      <th>Updated at</th>
                      <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($teachers as $teacher)
                      <tr>
                        <td>{{$teacher->id}}</td>
                        <td>{{$teacher->first_name . ' ' . $teacher->last_name}}</td>
                        <td>{{$teacher->phone}}</td>
                        <td>{{$teacher->email}}</td>
                        <td>{{$teacher->age}}</td>
                        <td>{{$teacher->status}}</td>
                        <td>{{$teacher->sex}}</td>
                        {{-- <td>{{$teacher->created_at}}</td> --}}
                        <td>{{$teacher->updated_at}}</td>

                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-info">
                              <i class="fas fa-edit"></i>
                            </button>
                          </div>

                          <div class="btn-group">
                            <button type="button" class="btn btn-danger">
                              <i class="fas fa-trash"></i>
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
    
@endsection