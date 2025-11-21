@extends('themes.basic.layouts.single')
@section('noindex', true)
@section('section', translate('Checkout'))
@section('header_title', translate('Complete the payment'))
@section('title', translate('Complete the payment'))
@section('body_bg', 'bg-white')
@section('breadcrumbs', Breadcrumbs::render('checkout', $trx))
@section('header_v3', true)
@section('content')






    <script>
        // Countdown Timer
        const expiryDate = new Date("{{ $data->expiryDate }}").getTime();
        const countdownElem = document.getElementById('countdown');

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = expiryDate - now;

            if (distance < 0) {
                countdownElem.innerHTML = "Expired";
                clearInterval(countdownInterval);
                clearInterval(statusInterval);
                return;
            }

            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElem.innerHTML = minutes + "m " + seconds + "s ";
        }

        updateCountdown();
        const countdownInterval = setInterval(updateCountdown, 1000);

        var url = "{{ route('payments.ipn.basqet') }}?payment_id={{ $data->_id }}&reference={{$data->externalReference}}&status=0";
        console.log('====================================');
        console.log(url);
        console.log('====================================');
        // AJAX Polling for Payment Status
        function checkPaymentStatus() {
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => response.json())
            // .then(response => {
            //     console.log('====================================');
            //     console.log(response.json()->message);
            //     console.log('====================================');
            // })
            .then(data => {
                console.log(data.message);
                if (data.status != 200) {
                    
                console.log(data.message);
                } else {
                    window.location.href = data.url;
                }
                
            })
            .catch(error => {
                // Optionally handle errors
                console.log(error);
            });
        }

        // Poll every 10 seconds
        const statusInterval = setInterval(checkPaymentStatus, 10000);
    </script>

@endsection
