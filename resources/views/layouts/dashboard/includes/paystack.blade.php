<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    function payWithPaystack(amount, sub_id, type) {
        // e.preventDefault();
        let handler = PaystackPop.setup({
            key: 'pk_test_93253e4094828ef15dfd864b9decb3dfceb75a8f', // Replace with your public key
            // email: document.getElementById("email-address").value,
            // amount: document.getElementById("amount").value * 100,
            email: "{{ Auth::user()->email }}",
            amount: parseInt(amount) * 100,
            currency: "NGN",
            ref: '' + Math.floor((Math.random() * 1000000000) +
                1
            ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            // label: "Optional string that replaces customer email"
            callback: function(response) {
                // console.log(response);
                //this happens after the payment is completed successfully
                save(sub_id, type, response)
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            },
            onClose: function() {
                // alert('Transaction was not completed, window closed.');
            },
        });

        handler.openIframe();
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
                    reference: response.reference,
                    status: response.status,
                    trxref: response.trxref,
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


    function material(amount, sub_id, type) {
        // e.preventDefault();

        let handler = PaystackPop.setup({
            key: 'pk_test_93253e4094828ef15dfd864b9decb3dfceb75a8f', // Replace with your public key
            // email: document.getElementById("email-address").value,
            // amount: document.getElementById("amount").value * 100,
            email: "{{ Auth::user()->email }}",
            amount: parseInt(amount) * 100,
            currency: "{{ Auth::user()->currency->code ?? 'NGN' }}",
            ref: '' + Math.floor((Math.random() * 1000000000) +
                1
            ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            // label: "Optional string that replaces customer email"
            callback: function(response) {
                console.log(amount, sub_id, type);
                saveMaterial(amount, sub_id, type, response)
                // console.log(response);
                //this happens after the payment is completed successfully
                // saveBuy(sub_id, type, response)
                setTimeout(function() {
                    window.location.href = "{{ route('user.library') }}";
                }, 2000);
            },
            onClose: function() {
                // alert('Transaction was not completed, window closed.');
            },
        });

        handler.openIframe();
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
                            reference: response.reference,
                            status: response.status,
                            trxref: response.trxref,
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
