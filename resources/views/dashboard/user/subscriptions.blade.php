<div class="card border-10 pt-2 card-primary">
    <div class="card-body">
        @if (Auth::user()->user_type == 'student')
            <h5 class="font-weight-bold">Student Subscription</h5>
            @isset($subs)
                @foreach ($subs as $sub)
                    @if ($sub->type == 'student')
                        @if ($sub->session)
                            <div class="row mb-4">
                                <div class="col-sm-6 col-xl-4">
                                    <div class="panel price panel-color bg-white">
                                        <div class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                            <div class="bg-warning-transparent pricing-svg">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="panel-heading p-0 pb-0 text-center">
                                            <h4 class="font-weight">Student {{ $sub->name }}</h4>
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
                                            @if (Auth::user()->sub->subscription_id == $sub->id)
                                                <a class="btn btn-lg btn-gray text-white" @disabled(true)
                                                    style="cursor: no-drop">Subcribed</a>
                                            @else
                                                <a class="btn btn-lg btn-warning"
                                                    @isset($sub->session)
                                                onclick="flutterwaveCheckout('{{ $sub->session }}', '{{ $sub->id }}', 'session')"
                                                @endisset
                                                    @isset($sub->system)
                                                onclick="flutterwaveCheckout('{{ $sub->system }}', '{{ $sub->id }}', 'system')"
                                                @endisset>
                                                    @if (Auth::user()->sub->subscription_id)
                                                        Change
                                                    @else
                                                        Subscribe
                                                    @endif
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($sub->system)
                            <div class="row mb-4">
                                <div class="col-sm-6 col-xl-4">
                                    <div class="panel price panel-color bg-white">
                                        <div class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                            <div class="bg-success-transparent pricing-svg">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="panel-heading p-0 pb-0 text-center">
                                            <h4 class="font-weight">Student {{ $sub->name }}</h4>
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
                                            @if (Auth::user()->sub->subscription_id == $sub->id)
                                                <a class="btn btn-lg btn-gray text-white" @disabled(true)
                                                    style="cursor: no-drop">Subcribed</a>
                                            @else
                                                <a class="btn btn-lg btn-success"
                                                    @isset($sub->session)
                                                onclick="flutterwaveCheckout('{{ $sub->session }}', '{{ $sub->id }}', 'session')"
                                                @endisset
                                                    @isset($sub->system)
                                                onclick="flutterwaveCheckout('{{ $sub->system }}', '{{ $sub->id }}', 'system')"
                                                onclick="flutterwaveCheckout('{{ $sub->system }}', '{{ $sub->id }}', 'system')"
                                                @endisset>
                                                    @if (Auth::user()->sub->subscription_id)
                                                        Change
                                                    @else
                                                        Subscribe
                                                    @endif
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            @endisset
        @endif

        @if (Auth::user()->user_type == 'professionals')
            @isset($subs)
                @foreach ($subs as $sub)
                    <div class="row mb-5">
                        @isset($sub->annual)
                            <h5 class="font-weight-bold mb-4 mt-5">{{ $sub->name }}</h5>
                            <div class="col-sm-6 col-xl-3 ">
                                <div class="panel price panel-color">
                                    <div class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                        <div
                                            class="pricing-svg 
                                    @if ($sub->name == 'SINGLE USER') bg-warning-transparent @endif
                                    @if ($sub->name == 'GROUP USERS (5)') bg-success-transparent @endif
                                    @if ($sub->name == 'GROUP USERS (10)') bg-secondary-transparent @endif">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="panel-heading p-0 pb-0 text-center">
                                        <h5 class="">
                                            {{ $sub->name }}</h5>
                                    </div>
                                    <ul class="text-center">
                                        <li class="mb-4">
                                            <strong class="font-weight-bold">₦{{ number_format($sub->annual, 2) }}
                                            </strong>/ Annual
                                        </li>
                                        <li class="mb-4">
                                            @isset($sub->max_teammate)
                                                <strong>{{ $sub->max_teammate }}
                                                    Users</strong>
                                            @endisset
                                        </li>
                                    </ul>
                                    <div class="panel-footer text-center border-top-0 mb-4">
                                        @if (Auth::user()->sub->subscription_id == $sub->id && $sub_amount == $sub->annual)
                                            <a class="btn btn-lg btn-gray text-white" @disabled(true)
                                                style="cursor: no-drop">Subcribed</a>
                                        @else
                                            <a onclick="flutterwaveCheckout('{{ $sub->annual }}', '{{ $sub->id }}', 'annual')"
                                                class="btn btn-lg text-white font-weight-bold
                                            @if ($sub->name == 'SINGLE USER') bg-warning @endif
                                            @if ($sub->name == 'GROUP USERS (5)') bg-success @endif
                                            @if ($sub->name == 'GROUP USERS (10)') bg-secondary @endif "
                                                href="#">
                                                @if (Auth::user()->sub->subscription_id)
                                                    Change
                                                @else
                                                    Subscribe
                                                @endif
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endisset
                        @isset($sub->quarterly)
                            <div class="col-sm-6 col-xl-3">
                                <div class="panel price panel-color bg-white">
                                    <div class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                        <div
                                            class="pricing-svg
                                    @if ($sub->name == 'SINGLE USER') bg-warning-transparent @endif
                                    @if ($sub->name == 'GROUP USERS (5)') bg-success-transparent @endif
                                    @if ($sub->name == 'GROUP USERS (10)') bg-secondary-transparent @endif">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="panel-heading p-0 pb-0 text-center">
                                        <h5>{{ $sub->name }}</h5>
                                    </div>
                                    <ul class="text-center">
                                        <li class="mb-4">
                                            <strong class="font-weight-bold">₦{{ number_format($sub->quarterly, 2) }}
                                            </strong>/ Quarterly
                                        </li>
                                        <li class="mb-4">
                                            @isset($sub->max_teammate)
                                                <strong>{{ $sub->max_teammate }}
                                                    Users</strong>
                                            @endisset
                                        </li>
                                    </ul>
                                    <div class="panel-footer text-center border-top-0 mb-4">
                                        @if (Auth::user()->sub->subscription_id == $sub->id && $sub_amount == $sub->quarterly)
                                            <a class="btn btn-lg btn-gray text-white" @disabled(true)
                                                style="cursor: no-drop">Subcribed</a>
                                        @else
                                            <a onclick="flutterwaveCheckout('{{ $sub->quarterly }}', '{{ $sub->id }}', 'quarterly')"
                                                class="btn btn-lg text-white font-weight-bold
                                            @if ($sub->name == 'SINGLE USER') bg-warning @endif
                                            @if ($sub->name == 'GROUP USERS (5)') bg-success @endif
                                            @if ($sub->name == 'GROUP USERS (10)') bg-secondary @endif "
                                                href="#">
                                                @if (Auth::user()->sub->subscription_id)
                                                    Change
                                                @else
                                                    Subscribe
                                                @endif
                                            </a>
                                            <a onclick="flutterwaveCheckout('{{ $sub->quarterly }}', '{{ $sub->id }}', 'quarterly')"
                                                class="btn btn-lg text-white font-weight-bold
                                            @if ($sub->name == 'SINGLE USER') bg-warning @endif
                                            @if ($sub->name == 'GROUP USERS (5)') bg-success @endif
                                            @if ($sub->name == 'GROUP USERS (10)') bg-secondary @endif "
                                                href="#">
                                                @if (Auth::user()->sub->subscription_id)
                                                    Change
                                                @else
                                                    Subscribe
                                                @endif
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endisset
                        @isset($sub->monthly)
                            <div class="col-sm-6 col-xl-3">
                                <div class="panel price panel-color bg-white">
                                    <div class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                        <div
                                            class="pricing-svg
                                    @if ($sub->name == 'SINGLE USER') bg-warning-transparent @endif
                                    @if ($sub->name == 'GROUP USERS (5)') bg-success-transparent @endif
                                    @if ($sub->name == 'GROUP USERS (10)') bg-secondary-transparent @endif">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="panel-heading p-0 pb-0 text-center">
                                        <h5>{{ $sub->name }}</h5>
                                    </div>
                                    <ul class="text-center">
                                        <li class="mb-4">
                                            <strong class="font-weight-bold">₦{{ number_format($sub->monthly, 2) }}
                                            </strong>/ Monthly
                                        </li>
                                        <li class="mb-4">
                                            @isset($sub->max_teammate)
                                                <strong>{{ $sub->max_teammate }}
                                                    Users</strong>
                                            @endisset
                                        </li>
                                    </ul>
                                    <div class="panel-footer text-center border-top-0 mb-4">
                                        @if (Auth::user()->sub->subscription_id == $sub->id && $sub_amount == $sub->monthly)
                                            <a class="btn btn-lg btn-gray text-white" @disabled(true)
                                                style="cursor: no-drop">Subcribed</a>
                                        @else
                                            <a onclick="flutterwaveCheckout('{{ $sub->monthly }}', '{{ $sub->id }}', 'monthly')"
                                                class="btn btn-lg text-white font-weight-bold
                                            @if ($sub->name == 'SINGLE USER') bg-warning @endif
                                            @if ($sub->name == 'GROUP USERS (5)') bg-success @endif
                                            @if ($sub->name == 'GROUP USERS (10)') bg-secondary @endif "
                                                href="#">
                                                @if (Auth::user()->sub->subscription_id)
                                                    Change
                                                @else
                                                    Subscribe
                                                @endif
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endisset
                        @isset($sub->weekly)
                            <div class="col-sm-6 col-xl-3">
                                <div class="panel price panel-color bg-white">
                                    <div class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                        <div
                                            class="pricing-svg
                                    @if ($sub->name == 'SINGLE USER') bg-warning-transparent @endif
                                    @if ($sub->name == 'GROUP USERS (5)') bg-success-transparent @endif
                                    @if ($sub->name == 'GROUP USERS (10)') bg-secondary-transparent @endif">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="panel-heading p-0 pb-0 text-center">
                                        <h5>{{ $sub->name }}</h5>
                                    </div>
                                    <ul class="text-center">
                                        <li class="mb-4">
                                            <strong class="font-weight-bold">₦{{ number_format($sub->weekly, 2) }}
                                            </strong>/ Weekly
                                        </li>
                                        <li class="mb-4">
                                            @isset($sub->max_teammate)
                                                <strong>{{ $sub->max_teammate }}
                                                    Users</strong>
                                            @endisset
                                        </li>
                                    </ul>
                                    <div class="panel-footer text-center border-top-0 mb-4">
                                        @if (Auth::user()->sub->subscription_id == $sub->id && $sub_amount == $sub->weekly)
                                            <a class="btn btn-lg btn-gray text-white" @disabled(true)
                                                style="cursor: no-drop">Subcribed</a>
                                        @else
                                            <a onclick="flutterwaveCheckout('{{ $sub->weekly }}', '{{ $sub->id }}', 'weekly')"
                                                class="btn btn-lg text-white font-weight-bold
                                            @if ($sub->name == 'SINGLE USER') bg-warning @endif
                                            @if ($sub->name == 'GROUP USERS (5)') bg-success @endif
                                            @if ($sub->name == 'GROUP USERS (10)') bg-secondary @endif "
                                                href="#">
                                                @if (Auth::user()->sub->subscription_id)
                                                    Change
                                                @else
                                                    Subscribe
                                                @endif
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endisset
                    </div>
                @endforeach
            @endisset
        @endif
    </div>
</div>
{{-- rgb(0 0 0 / 30%) 0px 19px 38px, rgb(0 0 0 / 22%) 0px 15px 12px --}}
