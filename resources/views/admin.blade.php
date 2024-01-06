
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
                    <h1 class="m-0">Data Admin</h1>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->password }}</td>
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
