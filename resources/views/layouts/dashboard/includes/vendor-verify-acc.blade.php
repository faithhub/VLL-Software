<script type="text/javascript">
    function verifyAccount() {
        try {
            document.getElementById("spinner").className = 'fa fa-spinner fa-spin';
            document.getElementById("verify-btn").innerText = 'Verifying';
            setTimeout(function() {
                const accountNumber = document.getElementById('acc_number').value
                const bank = document.getElementById('bank_id').value
                const bankCode = $('select#bank_id').find(':selected').data('code');

                console.log(accountNumber, bank, bankCode);
                if (!bank) {
                    document.getElementById("spinner").className = '';
                    document.getElementById("verify-btn").innerText = 'Verify';
                    return toastr.warning("Error", "Please select your bank");
                }
                if (!accountNumber) {
                    document.getElementById("spinner").className = '';
                    document.getElementById("verify-btn").innerText = 'Verify';
                    return toastr.warning("Error",
                        "Please input your account number");
                }

                $.ajax({
                    url: '{{ route('vendor.verifyBank') }}',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        type: "NGN",
                        account_number: accountNumber,
                        bank: bank,
                        bank_code: bankCode
                    },

                    success: function(response) {
                        if (!response.status) {
                            document.getElementById("spinner").className = '';
                            document.getElementById("verify-btn").innerText = 'Verify';
                            return toastr.warning("Error",
                                "Invalid account details");
                        }

                        document.getElementById("spinner").className = 'fa fa-lock';
                        document.getElementById("verify-btn").innerText = 'Verified';
                        document.getElementById("verify-me").disabled = true;
                        document.getElementById('bank_id').disabled = true;
                        document.getElementById('acc_number').readOnly = true;
                        document.getElementById('acc_name').value = response.data
                            .account_name
                        return toastr.success("Success",
                            "Account verified");
                    },
                    error: function(err) {
                        document.getElementById("spinner").className = '';
                        document.getElementById("verify-btn").innerText = 'Verify';
                        console.log(err);
                    }
                });
            }, 2000);
        } catch (error) {
            console.log(error);
        }
    }


    function verifyDomAccount() {
        try {
            document.getElementById("dom_spinner").className = 'fa fa-spinner fa-spin';
            document.getElementById("dom_verify-btn").innerText = 'Verifying';
            setTimeout(function() {
                const accountNumber = document.getElementById('dom_acc_number').value
                const bank = document.getElementById('dom_bank_id').value
                const bankCode = $('select#dom_bank_id').find(':selected').data('code');

                console.log(accountNumber, bank, bankCode);
                if (!bank) {
                    document.getElementById("dom_spinner").className = '';
                    document.getElementById("dom_verify-btn").innerText = 'Verify';
                    return toastr.warning("Error", "Please select your bank");
                }
                if (!accountNumber) {
                    document.getElementById("dom_spinner").className = '';
                    document.getElementById("dom_verify-btn").innerText = 'Verify';
                    return toastr.warning("Error",
                        "Please input your account number");
                }

                $.ajax({
                    url: '{{ route('vendor.verifyBank') }}',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        type: "USD",
                        account_number: accountNumber,
                        bank: bank,
                        bank_code: bankCode
                    },

                    success: function(response) {
                        if (!response.status) {
                            document.getElementById("dom_spinner").className = '';
                            document.getElementById("dom_verify-btn").innerText = 'Verify';
                            return toastr.warning("Error",
                                "Invalid account details");
                        }

                        document.getElementById("dom_spinner").className = 'fa fa-lock';
                        document.getElementById("dom_verify-btn").innerText = 'Verified';
                        document.getElementById("dom_verify-me").disabled = true;
                        document.getElementById('dom_bank_id').disabled = true;
                        document.getElementById('dom_acc_number').readOnly = true;
                        document.getElementById('dom_acc_name').value = response.data
                            .account_name
                        return toastr.success("Success",
                            "Account verified");
                    },
                    error: function(err) {
                        document.getElementById("dom_spinner").className = '';
                        document.getElementById("dom_verify-btn").innerText = 'Verify';
                        console.log(err);
                    }
                });
            }, 2000);
        } catch (error) {
            console.log(error);
        }
    }
</script>
