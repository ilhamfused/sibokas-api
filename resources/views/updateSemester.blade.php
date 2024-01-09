<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400&display=swap" rel="stylesheet">


    <title>Update Semester</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Semester</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('semester.update', $semesters->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div>
                                    <label for="name">Name</label>
                                </div>
                                <div>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $semesters->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <label for="date">Start Date</label>
                                </div>
                                <div>
                                    <input type="date" class="form-control" id="date" name="start_date" value="{{ $semesters->start_date }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="date">End Date</label>
                                </div>
                                <div>
                                    <input type="date" class="form-control" id="date" name="end_date" value="{{ $semesters->end_date }}">
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
