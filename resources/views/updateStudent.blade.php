<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400&display=swap" rel="stylesheet">


    <title>Tambah Student</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Student</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('student.update', $student->id)  }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div>
                                    <label for="name">Name</label>
                                </div>
                                <div>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <label for="email">Email</label>
                                </div>
                                <div>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $student->email }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <label for="password">Password</label>
                                </div>
                                <div>
                                    <input  class="form-control" id="pwd" name="password" value="">
                                </div>
                            </div>
                            <div class="btn-submit">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
