<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: background-color: rgb(249, 249, 249);
        }

        .container-1 {
            background-color: rgb(118, 168, 244);
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container-2 {
            display: flex;
            justify-content: center;
            flex-direction: column;

            align-items: center;
            height: 100vh;
            width: 100%;
        }

        .btn-block {
            width: 100%;
        }

        .form-login {
            width: 70%;
        }
    </style>
</head>

<body>


    <div data-session="{{ session('loginError') }}"></div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="container-1">
                    <img src="{{ asset('assets/img/login.png') }}" class="w-75 gambar-login" alt="">
                </div>
            </div>

            <div class="col-md-5">
                <div class="container-2">
                    <div class="header-login">
                        <h3 class="font-weight-bold">Welcome to my App</h3>
                        <p>Please login to your account. </p>
                    </div>
                    <div class="form-login">
                        <form action="login" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" aria-describedby="emailHelp"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password">
                                @error('password')
                                    <div class="form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary btn-block">Login </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    {{-- sweatalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const session = document.querySelector('[data-session]').dataset.session
        if (session) {
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: session
            })
        }
    </script>
</body>

</html>
