
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
                    <h1 class="m-0">Data Semester</h1>
                  </div>
                    <a href="{{ route('tambahSemester') }}">
                    <button class="btn btn-primary ml-auto">Tambah</button>
                  </a>
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
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($semesters as $key => $semester)
                                <tr>
                                    <td>{{ $semesters->firstItem() + $key }}</td>
                                    <td>{{ $semester->name }}</td>
                                    <td>{{ $semester->start_date }}</td>
                                    <td>{{ $semester->end_date }}</td>
                                    <td>
                                      <a href="{{ route('semester.edit', $semester->id) }}" class="btn btn-info">Edit</a>
                                      <form action="{{ route('deletesemester', $semester->id) }}" method="post" style="display:inline;">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')">Delete</button>
                                      </form>
                                    </td>
                                </tr>
                                @endforeach

                            <!-- Add more rows as needed -->
                          </tbody>
                        </table>
                        <br>
                        <div class="d-flex justify-content-center">
                            {{ $semesters->links() }}
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
