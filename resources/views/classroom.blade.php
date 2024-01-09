
@extends('layouts.app')

@section('content')
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-11">
                    <h1 class="m-0">Data Classroom</h1>
                  </div>
                    <button class="btn btn-primary ml-auto">Tambah</button>
                </div>

              </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <!-- Table -->
                    <div class="card">
                      <!-- <div class="card-header">
                        <h3 class="card-title">Example Table</h3>
                      </div> -->
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table class="table table-bordered table-striped text-center">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Name</th>
                              <th>Name Alias</th>
                              <th>Status</th>
                              <th>Photo</th>
                              <th>PIC Room Id</th>
                              <th>Building Id</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($classrooms as $key => $classroom)
                                <tr>
                                    <td>{{ $classrooms->firstItem() + $key }}</td>
                                    <td>{{ $classroom->name }}</td>
                                    <td>{{ $classroom->name_alias }}</td>
                                    <td>{{ $classroom->status }}</td>
                                    <td>{{ $classroom->photo }}</td>
                                    <td>{{ $classroom->pic_room_id }}</td>
                                    <td>{{ $classroom->building_id }}</td>
                                    <td>
                                      <button class="btn btn-info">Edit</button>
                                      <button class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                                @endforeach

                            <!-- Add more rows as needed -->
                          </tbody>
                        </table>
                        <br>
                        <div class="d-flex justify-content-center">
                            {{ $classrooms->links() }}
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.content -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

    <!-- AdminLTE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
  </div>
</body>
@endsection
