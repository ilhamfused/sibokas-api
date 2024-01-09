
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
                    <h1 class="m-0">Data Classroom Schedule</h1>
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
                                    <th>Day of Week</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Semester Id</th>
                                    <th>Classroom Id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classroom_schedules as $key => $schedule)
                                    <tr>
                                        <td>{{ $classroom_schedules->firstItem() + $key }}</td>
                                        <td>{{ $schedule->day_of_week }}</td>
                                        <td>{{ $schedule->start_time }}</td>
                                        <td>{{ $schedule->end_time }}</td>
                                        <td>{{ $schedule->semester_id }}</td>
                                        <td>{{ $schedule->classroom_id }}</td>
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
                            {{ $classroom_schedules->links() }}
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
