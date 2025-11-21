<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom CSS to center the content vertically */
        html,
        body {
            height: 100%;
        }

        .center-screen {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>

    <div class="center-screen">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 col-lg-4">

                    <div class="card p-4 shadow-sm">

                        <div class="card-header bg-white border-0">
                            <h2 class="text-start">Login</h2>
                        </div>

                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>

                                <div class="mb-4">
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                </div>

                                <button type="submit" class="btn btn-primary" id="loginbutton">Login</button>
                                <a href="/" class="btn btn-primary">Signup</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#loginbutton').on('click', function(e) {
                e.preventDefault();
                const email = $('#email').val();
                const password = $('#password').val();

                $.ajax({
                    url: '/api/login',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        email: email,
                        password: password
                    }),
                    success: function(response) {
                        //console.log(response);

                        localStorage.setItem('api_token',response.token);
                        window.location.href = "/allposts";
                    },
                    error:function(xhr,status,error){
                      alert('Error:' + xhr.responseText);
                    }
                })
            })
        });
    </script>
</body>

</html>
