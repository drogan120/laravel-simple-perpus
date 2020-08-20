<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Perpus - Login</title>
    <link href="{{ asset('paper-admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('paper-admin/assets/css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
</head>

<body>

    <div class="container">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-4">
                <div class="card mt-5">
                    <h4 class="text-secondary mx-auto">Login</h4>
                    <div class="card-body">
                        <form action="{{ url('login') }}" method="POST">
                            <div class="form-group">
                                @csrf
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="your@email.com">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password..">
                            </div>
                            <div class="d-inline float-right">
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-info">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('paper-admin/assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('paper-admin/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('paper-admin/assets/js/core/bootstrap.min.js') }}"></script>
</body>

</html>
