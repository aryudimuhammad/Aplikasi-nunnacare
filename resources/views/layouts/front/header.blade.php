@section('head')
<link href="signin.css" rel="stylesheet">
@endsection
    <div class="container d-flex flex-wrap justify-content-center">

        <a href="/" class="d-flex  me-lg-5 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <img src="../logo/logoputih.png" style="width: 40px; height: 42px; margin-right: 15px;" class="img-fluid" alt="image">
            </svg>
            <span class="fs-4">Nunnacare</span>
        </a>

        <ul class="navbar-nav me-lg-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Kategori
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    @foreach($kategori as $d)
                        <form action="/" method="post">
                            @csrf
                            <input hidden type="text" value="{{ $d->id }}" name="kategori">
                            <li><button class="dropdown-item btn-sm" type="submit">{{ $d->nama_kategori }}</button>
                            </li>
                        </form>
                    @endforeach
                </ul>
            </li>
        </ul>

        <form action="/" method="GET">
            <input type="text" class="form-control" placeholder="Search..." name="search" id="search"
                aria-label="Search">
        </form>




@if(Route::has('login'))
@auth


<ul class="navbar-nav">
<li class="nav-item dropdown" style="margin-left: 20px;">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                            Dashboard Admin
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                            <form id="logout-form" action="{{ route('logout') }}"
                            method="POST" class="d-none">
                            @csrf
                        </form>

                        </div>
                    </li>
</ul>
@else
<button class="btn btn-outline-secondary" type="button" style="margin-left: 20px;" data-bs-toggle="offcanvas"
    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"> Sign Up
</button>
@endauth
@endif


<!--------- Canvas --------->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Form Login/Signup</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <main class="form-signin w-100 m-auto">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h1 class="h3 mb-3 fw-normal">Login</h1>
                            <div class="form-floating">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    autofocus>
                                <label for="email">Email address</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    id="password" required autocomplete="current-password">
                                <label for="password">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <button class="w-100 btn btn-lg btn-primary" style="margin-bottom: 10%;"
                                type="submit">Sign in</button>
                        </form>
                    </main>


                        <br>
                        <hr><br>
                        <main class="form-register" style="margin-top: 10%;">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <h1 class="h3 mb-3 fw-normal">Register</h1>

                                <div class="form-floating">
                                    <input id="name" type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" required autocomplete="name"
                                        autofocus>
                                    <label for="name">Nama</label>
                                </div>

                                <div class="form-floating">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{ old('email') }}" required
                                        autocomplete="email">
                                    <label for="email">Email Address</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-floating">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required autocomplete="new-password">
                                    <label for="password">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-floating">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" id="password_confirmation" required
                                        autocomplete="new-password">
                                    <label for="password_confirmation">Password Confirmation</label>
                                </div>

                                <button type="submit" class="w-100 btn btn-lg btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </form>
                        </main>
    </div>
</div>



    </div>




