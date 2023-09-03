@php
    $currency = Auth::user()->currency->code ?? $app_default_currency->code;
@endphp
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script type="text/javascript">
    console.log("{{ Auth::user()->default_currency_id }}");

    function flutterwaveCheckout(amount, sub_id, type) {
        const currency = "{{$currency}}";
        FlutterwaveCheckout({
            // public_key: "FLWPUBK_TEST-006e9a2dde4eb5947f2da2af0c2f3695-X",
            public_key: "FLWPUBK-2e0795000c795271594541388f09b14f-X",
            tx_ref: "VLL-" + Math.floor((Math.random() * 100000000000000) + 1),
            amount: amount,
            currency: currency,
            // redirect_url: "{{ route('confirm.payment') }}",
            payment_options: "card",
            callback: function(payment) {
                if (payment.status == "successful") {
                    console.log(payment);
                    save(sub_id, type, payment)
                    setTimeout(function() {
                    window.location.href = "{{ route('user.transactions') }}";
                    }, 2000);
                    return toastr.success("{{ session('success') }}", "Payment Successful");
                } else {
                    return toastr.error("{{ session('error') }}", "Payment Failed");
                }
            },
            onclose: function(incomplete) {
                if (incomplete || window.verified === false) {
                    console.log(incomplete, 'failed');
                } else {
                    if (window.verified == true) {
                        console.log(incomplete, 'success');
                    } else {
                        console.log(incomplete, 'pending');
                    }
                }
            },
            customer: {
                email: "{{ Auth::user()->email }}",
                name: "{{ Auth::user()->name }}",
            },
        });
    }

    function save(id, type, response) {
        try {
            var userType = "{{ Auth::user()->role }}"
            let url = ""
            if (userType == "user") {
                url = "{{ route('user.subscribe') }}";
            }
            if (userType == "vendor") {
                url = "{{ route('vendor.subscribe') }}";
            }
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    sub_id: id,
                    type: type,
                    reference: response.transaction_id,
                    status: response.status,
                    invoice_id: response.tx_ref,
                    trxref: response.transaction_id,
                },

                success: function(response) {
                    console.log(response);
                    return toastr.success("{{ session('success') }}", "Payment Successful");
                },
                error: function(err) {
                    console.log(err);
                    return toastr.error("{{ session('error') }}", "Payment Failed");
                }
            });
        } catch (error) {
            console.log(error);
        }
    }

     function flutterwaveBuyMaterial(amount, sub_id, type) {
        const currency = "{{$currency}}";
        console.log(currency, amount);
        FlutterwaveCheckout({
            public_key: "FLWPUBK_TEST-006e9a2dde4eb5947f2da2af0c2f3695-X",
            tx_ref: "VLL-" + Math.floor((Math.random() * 100000000000000) + 1),
            amount: amount,
            currency: currency,
            // redirect_url: "{{ route('confirm.payment') }}",
            payment_options: "card",
            callback: function(payment) {
                if (payment.status == "successful") {
                    console.log(payment);
                    saveMaterial(amount, sub_id, type, payment)
                    setTimeout(function() {
                    window.location.href = "{{ route('user.library') }}";
                    }, 2000);
                    return toastr.success("{{ session('success') }}", "Payment Successful");
                } else {
                    return toastr.error("{{ session('error') }}", "Payment Failed");
                }
            },
            onclose: function(incomplete) {
                if (incomplete || window.verified === false) {
                    console.log(incomplete, 'failed');
                } else {
                    if (window.verified == true) {
                        console.log(incomplete, 'success');
                    } else {
                        console.log(incomplete, 'pending');
                    }
                }
            },
            customer: {
                email: "{{ Auth::user()->email }}",
                name: "{{ Auth::user()->name }}",
            },
        });
    }


    function saveMaterial(amount, id, type, response) {
        try {
            url = "{{ route('user.rent.buy') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    mat_id: id,
                    type: type,
                    amount: amount,
                    reference: response.transaction_id,
                    status: response.status,
                    trxref: response.transaction_id,
                },

                success: function(response) {
                    console.log(response);
                    return toastr.success("{{ session('success') }}", "Payment Successful");
                },
                error: function(err) {
                    console.log(err);
                    return toastr.error("{{ session('error') }}", "Payment Failed");
                }
            });
        } catch (error) {
            console.log(error);
        }
    }
</script>
