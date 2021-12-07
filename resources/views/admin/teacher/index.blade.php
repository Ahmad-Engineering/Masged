
@extends('admin.parent')

@section('title', 'Teachers')

@section('capital-title', 'Teachers')
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
                        <td>
                          @if ($teacher->active)
                            <span class="badge bg-success">{{$teacher->status}}</span>
                          
                            @else
                            <span class="badge bg-danger">{{$teacher->status}}</span>
                          @endif
                        </td>
                        <td>{{$teacher->gender}}</td>
                        {{-- <td>{{$teacher->sex}}</td> --}}
                        {{-- <td>{{$teacher->created_at}}</td> --}}
                        <td>{{$teacher->updated_at}}</td>

                        <td>
                          <div class="btn-group">
                            <a href="{{route('teacher.edit', $teacher->id)}}" class="btn btn-info">
                              <i class="fas fa-edit"></i>
                            </a>
                          </div>

                          <div class="btn-group">
                            <button type="button" class="btn btn-danger" onclick="confirmDestroy({{$teacher->id}}, this)">
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
    <script>
      function confirmDestroy(id, refranec) {
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
        // masged/admin/teacher/{teacher}
        axios.delete('/masged/manager/teacher/' + id)
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