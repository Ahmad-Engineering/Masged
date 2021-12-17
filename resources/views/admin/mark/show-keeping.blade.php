
@extends('admin.parent')

@section('title', 'Keeps')

@section('capital-title', 'Keeps')
@section('home-title', 'Keeps')
@section('small-title', 'cricle-keeps')

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
                <h3 class="card-title">Keeps</h3>

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
                      <th>Student</th>
                      <th>Circle name</th>
                      <th>Page</th>
                      <th>At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($circles as $circle)
                      @foreach ($circle->students as $student)
                        @foreach ($circle->qurans as $quran)
                          <tr>
                            <td>{{$student->id}}</td>
                            <td>{{$student->first_name . ' ' . $student->last_name}}</td>
                            <td>{{$circle->name}}</td>
                            <td>{{$quran->from_page . ' - To - ' . $quran->to_page}}</td>
                            <td>{{$quran->updated_at->format('d M y')}}</td>
                          </tr>
                        @endforeach
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