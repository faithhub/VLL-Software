<nav class="navbar navbar-two navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-2 col-md-3">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img class="logo" src="{{ asset('assets/web/logo/vll.png') }}" alt="logo">
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
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link sign-up-btn" href="#">Sign up</a></li>
                        <li class="nav-item"><a class="nav-link login-btn" href="#">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>