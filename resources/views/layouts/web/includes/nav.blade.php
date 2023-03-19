<nav class="navbar navbar-two navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-2 col-md-3">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img class="logo" src="{{ asset('assets/web/logo/vll-b.png') }}" alt="logo">
                </a>
            </div>

            <div class="col-12 col-lg-6 col-md-6">
            </div>

            <div class="col-12 col-lg-4 col-md-3">
                <div class="navbar-toggle-btn">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if (request()->is('login') || request()->is('register'))
                    @else
                        @auth
                            @if (Auth::user()->role == 'user')
                                <ul class="navbar-nav mx-auto">
                                    <li class="nav-item"><a class="nav-link login-btn"
                                            href="{{ route('user.index') }}">Dashboard</a>
                                    </li>
                                </ul>
                            @endif
                            @if (Auth::user()->role == 'vendor')
                                <ul class="navbar-nav mx-auto">
                                    <li class="nav-item"><a class="nav-link login-btn"
                                            href="{{ route('vendor.index') }}">Dashboard</a>
                                    </li>
                                </ul>
                            @endif
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'sub_admin')
                                <ul class="navbar-nav mx-auto">
                                    <li class="nav-item"><a class="nav-link login-btn"
                                            href="{{ route('admin.index') }}">Dashboard</a>
                                    </li>
                                </ul>
                            @endif
                        @else
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item"><a class="nav-link sign-up-btn" href="{{ route('register') }}">Sign
                                        up</a>
                                </li>
                                <li class="nav-item"><a class="nav-link login-btn" href="{{ route('login') }}">Login</a>
                                </li>
                            </ul>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>