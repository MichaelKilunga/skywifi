<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{asset('assets/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/bootstrap-icons.css')}}" />
    <link href="{{asset('assets/font-awesome.min.css')}}" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 40px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>

<body>

    <div class="login-container text-center">
        <h3 class="mb-4 fw-bold">Admin Login</h3>
        <p class="text-muted mb-4">Sign in to your dashboard</p>

        <!-- Message Alert -->
        <div id="message-alert" class="alert d-none" role="alert"></div>

        <form id="login-form">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="text-dark fas fa-user"></i></span>
                    <input type="text" id="username" class="form-control" placeholder="Username" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock text-danger"></i></span>
                    <input type="password" id="password" class="form-control" placeholder="Password" required>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{asset('bootstrap.bundle.min.js')}}"></script> 
    <script src="{{asset('assets/jquery-3.6.0.min.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loginForm = document.getElementById('login-form');
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const messageAlert = document.getElementById('message-alert');

            // Hardcoded credentials for this example
            const validUsername = 'admin';
            const validPassword = 'roots@2460';

            // Function to display a message
            function showMessage(message, type) {
                messageAlert.textContent = message;
                messageAlert.classList.remove('d-none', 'alert-success', 'alert-danger');
                messageAlert.classList.add(`alert-${type}`);
            }

            loginForm.addEventListener('submit', (event) => {
                event.preventDefault(); // Prevent default form submission

                const username = usernameInput.value;
                const password = passwordInput.value;

                if (username === validUsername && password === validPassword) {
                    showMessage('Login successful! Redirecting to dashboard...', 'success');
                    // In a real application, you would handle authentication here (e.g., API call)
                    // and then redirect the user.
                    setTimeout(() => {
                        window.location.href = '{{ route('admin.dashboard') }}'; // Redirect to the dashboard page
                    }, 1500);
                } else {
                    showMessage('Invalid username or password.', 'danger');
                }
            });
        });
    </script>
</body>

</html>
