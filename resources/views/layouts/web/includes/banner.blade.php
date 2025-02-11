<style>
    .main-banner-three {
        background-image: linear-gradient(269.64deg, rgba(57, 81, 133, 0.03) 0.28%, #395185 99.67%), url("{{ asset('assets/web/img/bg-book002.jpg') }}");
        background-repeat: no-repeat !important;
        background-size: cover !important;
        background-position: center !important;
    }
</style>


<div id="home" class="main-banner-three bg-f9faff">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="hero-slides owl-carousel owl-theme">
                            <div class="hero-content">
                                <h1>Find all your Legal related materials<br> in our virtual Library</h1>
                                @auth
                                    @if (Auth::user()->role == 'user')
                                        <a href="{{ route('user.index') }}" class="gt-btn">Go to Dashboard</a>
                                    @endif
                                    @if (Auth::user()->role == 'vendor')
                                        <a href="{{ route('vendor.index') }}" class="gt-btn">Go to Dashboard</a>
                                    @endif
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'sub_admin')
                                        <a href="{{ route('admin.index') }}" class="gt-btn">Go to Dashboard</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="gt-btn">Get Started</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
