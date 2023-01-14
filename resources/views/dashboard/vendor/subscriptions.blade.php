<div class="card border-10 pt-2 card-primary">
    <div class="card-body">
        {{-- <h5 class="font-weight-bold">Professional Subscription</h5> --}}
        @isset($subs)
            @foreach ($subs as $sub)
                <div class="row mb-5">
                    @isset($sub->annual)
                        <h5 class="font-weight-bold mb-4 mt-5">{{ $sub->name }}</h5>
                        <div class="col-sm-6 col-xl-3 ">
                            <div class="panel price panel-color">
                                <div class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                    <div class="pricing-svg 
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
                                    <a onclick="payWithPaystack(this)" class="btn btn-lg text-white font-weight-bold
                                    @if ($sub->name == 'SINGLE USER') bg-warning  @endif
                                    @if ($sub->name == 'GROUP USERS (5)') bg-success @endif
                                    @if ($sub->name == 'GROUP USERS (10)') bg-secondary @endif
                                    " href="#">Subscribe</a>
                                </div>
                            </div>
                        </div>
                    @endisset
                    @isset($sub->quarterly)
                        <div class="col-sm-6 col-xl-3">
                            <div class="panel price panel-color bg-white">
                                <div class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                    <div class="pricing-svg
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
                                    <a class="btn btn-lg text-white font-weight-bold
                                    @if ($sub->name == 'SINGLE USER') bg-warning @endif
                                    @if ($sub->name == 'GROUP USERS (5)') bg-success @endif
                                    @if ($sub->name == 'GROUP USERS (10)') bg-secondary @endif
                                    " href="#">Subscribe</a>
                                </div>
                            </div>
                        </div>
                    @endisset
                    @isset($sub->monthly)
                        <div class="col-sm-6 col-xl-3">
                            <div class="panel price panel-color bg-white">
                                <div class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                    <div class="pricing-svg
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
                                    <a class="btn btn-lg text-white font-weight-bold
                                    @if ($sub->name == 'SINGLE USER') bg-warning @endif
                                    @if ($sub->name == 'GROUP USERS (5)') bg-success @endif
                                    @if ($sub->name == 'GROUP USERS (10)') bg-secondary @endif
                                    " href="#">Subscribe</a>
                                </div>
                            </div>
                        </div>
                    @endisset
                    @isset($sub->weekly)
                        <div class="col-sm-6 col-xl-3">
                            <div class="panel price panel-color bg-white">
                                <div class="panel-heading p-0 pb-0 fs-30 text-center mt-5 mb-3">
                                    <div class="pricing-svg
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
                                    <a class="btn btn-lg text-white font-weight-bold
                                    @if ($sub->name == 'SINGLE USER') bg-warning @endif
                                    @if ($sub->name == 'GROUP USERS (5)') bg-success @endif
                                    @if ($sub->name == 'GROUP USERS (10)') bg-secondary @endif
                                    " href="#">Subscribe</a>
                                </div>
                            </div>
                        </div>
                    @endisset
                </div>
            @endforeach
        @endisset
    </div>
</div>
