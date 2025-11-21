<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
            <h3 class="text-center mb-4">Create Account</h3>

            <form>
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter a password" required>
                </div>

                <button type="submit" id="signup" class="btn btn-primary w-100">Sign Up</button>

                <p class="text-center mt-3">
                    Already have an account? <a href="/login">Login</a>
                </p>
            </form>

        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#signup').on('click', function(e) {
                e.preventDefault();

                const name = $('#name').val();
                const email = $('#email').val();
                const password = $('#password').val();

                $.ajax({
                    url: '/api/signup',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        name : name ,
                        email: email,
                        password: password
                    }),
                    success: function(response) {
                        console.log(response);

                        
                        window.location.href = "/login";
                    },
                    error: function(xhr, status, error) {
                        alert('Error:' + xhr.responseText);
                    }
                })
            })
        });
    </script>

</body>

</html>
