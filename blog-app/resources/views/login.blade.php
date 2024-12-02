<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Genshin Impact Blog</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', serif;
            background: url('https://www.chromethemer.com/download/hd-wallpapers/genshin-impact-1920x1080.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            z-index: 1;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent black */
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .card h2 {
            font-weight: 700;
            text-align: center;
            color: #ffcc00;
            /* Genshin yellow accent */
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ffcc00;
        }

        .btn-primary {
            background-color: #ffcc00;
            border-color: #ffcc00;
            color: #333;
            font-weight: 700;
        }

        .btn-primary:hover {
            background-color: #e6b800;
            border-color: #e6b800;
        }

        .alert-danger {
            background-color: rgba(255, 0, 0, 0.8);
            color: white;
        }

        .form-check-label {
            color: #fff;
        }

        .form-check-input {
            background-color: #ffcc00;
            border: 1px solid #ffcc00;
        }

        .form-check-input:checked {
            background-color: #e6b800;
            border-color: #e6b800;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="my-5">Login to Genshin Blog</h2>

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Display custom error message from session -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                    value="{{ old('email') }}">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <!-- Show Password checkbox -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="showPassword">
                                <label class="form-check-label" for="showPassword">Show Password</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript for Show Password -->
    <script>
        document.getElementById('showPassword').addEventListener('change', function() {
            var passwordField = document.getElementById('password');
            if (this.checked) {
                passwordField.type = 'text'; // Show the password
            } else {
                passwordField.type = 'password'; // Hide the password
            }
        });
    </script>

</body>

</html>
