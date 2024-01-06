
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
                  <div class="col-sm-6">
                    <h1 class="m-0">Data Classroom Report</h1>
                  </div>
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
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Photo</th>
                                    <th>Student Id</th>
                                    <th>Classsroom Id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classroom_reports as $key => $report)
                                <tr>
                                    <td>{{ $classroom_reports->firstItem() + $key }}</td>
                                    <td>{{ $report->title }}</td>
                                    <td>{{ $report->description  }}</td>
                                    <td>{{ $report->photo  }}</td>
                                    <!-- <td> <img src="{{ asset('storage/' . $report->photo) }}" style="max-width: 150px; max-height: 150px;"></td> -->
                                    <td>{{ $report->student_id  }}</td>
                                    <td>{{ $report->classroom_id  }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div class="d-flex justify-content-center">
                            {{ $classroom_reports->links() }}
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
