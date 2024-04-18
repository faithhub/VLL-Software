@php
    $currency = Auth::user()->currency->code ?? $app_default_currency->code;
@endphp
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script type="text/javascript">
    console.log("{{ Auth::user()->default_currency_id }}");

    const PUBLIC_KEY = "{{ getenv('PUBLIC_KEY') }}"


    function flutterwaveCheckout(amount, sub_id, type) {
        const currency = "{{ $currency }}";
        FlutterwaveCheckout({
            public_key: PUBLIC_KEY,
            tx_ref: sub_id + "#" + type + "@VLL-SUB-" + Math.floor((Math.random() * 100000000000000) + 1),
            amount: amount,
            currency: currency,
            redirect_url: "{{ route('confirm.payment') }}",
            // payment_options: "card",
            callback: function(payment) {
                console.log(payment);
                // if (payment.status == "successful") {
                //     console.log(payment);
                //     // save(sub_id, type, payment)
                //     setTimeout(function() {
                //     window.location.href = "{{ route('user.transactions') }}";
                //     }, 2000);
                //     return toastr.success("{{ session('success') }}", "Payment Successful");
                // } else {
                //     return toastr.error("{{ session('error') }}", "Payment Failed");
                // }
            },
            onclose: function(incomplete) {
                console.log(incomplete);
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

    function flutterwaveBuyMaterial(amount, mat_id, type, masterClass = null) {
        const currency = "{{ $currency }}";
            var tx_ref = mat_id + "#" + type + "@VLL-MATERIAL-" + Math.floor((Math.random() * 100000000000000) + 1);
            var redirect_url = "{{ route('material.payment') }}";
        if (masterClass == "class") {
            redirect_url = "{{ route('master-class.payment') }}";
            tx_ref = mat_id + "#" + type + "@VLL-MASTERCLASS-" + Math.floor((Math.random() * 100000000000000) + 1);
        }
        console.log(currency, amount, mat_id, type);
        FlutterwaveCheckout({
            public_key: PUBLIC_KEY,
            tx_ref: tx_ref,
            // tx_ref: "VLL-" + Math.floor((Math.random() * 100000000000000) + 1),
            amount: amount,
            currency: currency,
            redirect_url: redirect_url,
            payment_options: "card",
            callback: function(payment) {
                console.log(payment);
            },
            onclose: function(incomplete) {
                console.log(incomplete);
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
