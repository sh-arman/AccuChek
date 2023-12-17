<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="SFS | Shaheen Food Product liveCheck | Shaheen Food suppliers | Shaheen LiveCheck | Panacea Live Ltd.">
    <meta name="Author" content="Shajedul Hasan Arman | armanhassan504@gmail.com" />
    <meta name="description" content="" />
    <title>Login | ACCU Chek Radiant LiveCheck</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('front/images/panacealogo.png') }}" />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
</head>

<body>
    <div class="container p-y">
        <div class="row">
            <div class="col-md-5 mx-auto">

                <div class="container-xxl">
                    <div class="authentication-wrapper authentication-basic container-p-y">
                        <div class="authentication-inner">

                            <div class="card" style="background-color: #005670;">
                                <div class="card-body">
                                    <div class="app-brand justify-content-center">
                                        <a href="index.html" class="app-brand-link gap-2">
                                            <img src="{{ asset('front/images/acculogo.svg') }}" alt="Shaheen Food"
                                                style="width: 20rem; padding: .5rem 2rem;" />
                                        </a>
                                    </div>

                                    <h4 class="mb-2 text-center text-white">Login</h4>
                                    {{-- <p class="mb-4">Please sign-in to your account and start the adventure</p> --}}

                                    <form id="formAuthentication" class="mb-3" action="{{ route('custom_login') }}"
                                        method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="phone_number" class="form-label text-white">Phone Number</label>
                                            <input id="phone_number" type="phone_number"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                name="phone_number" value="{{ old('phone_number') }}" required
                                                autocomplete="phone_number" autofocus>

                                            @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="password" class="form-label text-white">Password</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <button class="btn btn-primary d-grid w-100 text-white" type="submit">Sign in</button>
                                        </div>
                                    </form>

                                    <p class="text-center mt-4 text-white">
                                        <script>
                                            document.write(new Date().getFullYear());
                                        </script> Copyright to
                                        <a href="https://panacea.live" target="_blank"
                                            class="footer-link fw-bolder text-white">Panacea Live Ltd</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    {{-- <div class="buy-now">
      <a href="" target="_blank" class="btn btn-danger btn-buy-now">Upgrade to Live Check Pro</a>
    </div> --}}
    <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}"></script>
</body>

</html>
