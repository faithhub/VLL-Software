<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="text-center">
                        @if ($type == 'access')
                            <h4>To access this material, please subscribe</h4>
                        @endif
                        @if ($type == 'buy')
                            <h4>To Buy/Rent this material, please subscribe</h4>
                        @endif
                        <a
                            href="{{ route('user.settings') }}"
                            class="sub-link btn p-2 font-weight-bold h4 btn-primary">Subscribe Now!</a>
                        {{-- <button onclick="shiNew(event)" data-type="dark" data-size="l" data-title="Subscribe"
                            href="{{ route('user.subscriptions') }}"
                            class="sub-link btn p-2 font-weight-bold h4 btn-primary">Subscribe Now!</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
