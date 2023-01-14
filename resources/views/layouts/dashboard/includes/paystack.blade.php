<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    function payWithPaystack(amount, email) {
        // e.preventDefault();

        let handler = PaystackPop.setup({
            key: 'pk_test_93253e4094828ef15dfd864b9decb3dfceb75a8f', // Replace with your public key
            // email: document.getElementById("email-address").value,
            // amount: document.getElementById("amount").value * 100,
            email: email,
            amount: parseInt(amount) * 100,
            currency: "NGN",
            ref: '' + Math.floor((Math.random() * 1000000000) +
                1
                ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            // label: "Optional string that replaces customer email"
            callback: function(response) {
                //this happens after the payment is completed successfully
                var reference = response.reference;
                alert('Payment complete! Reference: ' + reference);
                // Make an AJAX call to your server with the reference to verify the transaction
            },
            onClose: function() {
                alert('Transaction was not completed, window closed.');
            },
        });

        handler.openIframe();
    }
</script>
