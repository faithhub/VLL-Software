<div class="card border-10 pt-2 card-primary">
    <div class="card-body">
        <div class="row mb-4">
            <h5 class="font-weight-bold">Student Subscription</h5>
            @isset($subs)
                @foreach ($subs as $sub)
                    @if ($sub->type == 'student')
                        <div class="col-sm-6 col-xl-4">
                            <div class="panel price panel-color bg-white">
                                <div class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                    <div class="bg-primary-transparent pricing-svg">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="panel-heading p-0 pb-0 text-center">
                                    <h4 class="font-weight-bold">Student {{ $sub->name }}</h4>
                                </div>
                                <div class="panel-body text-center">
                                </div>
                                <ul class="text-center">
                                    <li class="mb-4">

                                        @isset($sub->session)
                                            <strong class="font-weight-bold">₦{{ number_format($sub->session, 2) }}
                                            </strong>/ {{ $sub->name }}
                                        @endisset

                                    </li>
                                    <li class="mb-4">

                                        @isset($sub->system)
                                            <strong class="font-weight-bold">₦{{ number_format($sub->system, 2) }}
                                            </strong>/ {{ $sub->name }}
                                        @endisset
                                    </li>
                                    <li class="mb-4">
                                        @isset($sub->session)
                                            <strong>{{ $sub->session_duration }} months</strong>
                                        @endisset
                                        @isset($sub->system)
                                            <strong>{{ $sub->system_duration }} months</strong>
                                        @endisset
                                    </li>
                                </ul>
                                <div class="panel-footer text-center border-top-0 mb-4">
                                    <a class="btn btn-lg btn-primary"
                                        href="#">Subscribe</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endisset
        </div>

        <div class="row">
            <h5 class="font-weight-bold">Professional Subscription</h5>
            @isset($subs)
                @foreach ($subs as $sub)
                    @if ($sub->type == 'professional')
                        <div class="col-sm-6 col-xl-4">
                            <div class="panel price panel-color bg-white">
                                <div class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                    <div class="bg-primary-transparent pricing-svg">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="panel-heading p-0 pb-0 text-center">
                                    <h4 class="font-weight-bold">
                                        {{ $sub->name }}</h4>
                                </div>
                                <ul class="text-center">
                                    <li class="mb-4">
                                        @isset($sub->annual)
                                            <strong class="font-weight-bold">₦{{ number_format($sub->annual, 2) }}
                                            </strong>/ annual
                                        @endisset
                                    </li>
                                    <li class="mb-4">
                                        @isset($sub->weekly)
                                            <strong class="font-weight-bold">₦{{ number_format($sub->weekly, 2) }}
                                            </strong>/ weekly
                                        @endisset
                                    </li>
                                    <li class="mb-4">
                                        @isset($sub->quarterly)
                                            <strong class="font-weight-bold">₦{{ number_format($sub->quarterly, 2) }}
                                            </strong>/ quarterly
                                        @endisset
                                    </li>
                                    <li class="mb-4">
                                        @isset($sub->monthly)
                                            <strong class="font-weight-bold">₦{{ number_format($sub->monthly, 2) }}
                                            </strong>/ monthly
                                        @endisset
                                    </li>
                                    <li class="mb-4">
                                        @isset($sub->weekly)
                                            <strong class="font-weight-bold">₦{{ number_format($sub->weekly, 2) }}
                                            </strong>/ weekly
                                        @endisset
                                    </li>
                                    <li class="mb-4">
                                        @isset($sub->max_teammate)
                                            <strong>{{ $sub->max_teammate }}
                                                Users</strong>
                                        @endisset
                                    </li>
                                </ul>
                                <div class="panel-footer   text-center border-top-0 mb-4">
                                    <a class="btn btn-lg btn-primary" href="#">Subscribe</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endisset
        </div>
    </div>
</div>
