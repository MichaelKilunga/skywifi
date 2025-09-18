<!doctype html>
<html lang="{{ session('locale') }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <title>KINGALU Wi-Fi | Connect & Pay</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons.css') }}" />
    <!-- <script src="{{-- asset('bootstrap.bundle.min.js') --}}"></script>  -->
    <link href="{{ asset('assets/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/google_fonts.css') }}" rel="stylesheet">
    {{-- <link href="{{asset('assets/flag-icons.min.css')}}" rel="stylesheet"> --}}
    {{-- JQUERY LINK --}}
    <script src="{{ asset('assets/jquery-3.6.0.min.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/v4-shims.min.css" rel="stylesheet">


    <style>
        :root {
            --bg: #0b1220;
            --card: #121a2b;
            --muted: #7b88a8;
            --accent: #22c55e;
            --accent-2: #0ea5e9;
            --danger: #ef4444;
            --ring: rgba(34, 197, 94, .35)
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            background: linear-gradient(180deg, #0b1220, #0b1220 40%, #0f172a 100%) fixed;
            color: #e5e7eb
        }


        .step-card {
            display: none;
        }

        .step-card.active {
            display: block;
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-accent {
            background: #22c55e;
            color: #06220f;
            border-radius: 14px;
            font-weight: 600;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 24px
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700
        }

        .brand img {
            width: 36px;
            height: 36px;
            border-radius: 10px
        }

        .lang {
            display: flex;
            gap: 8px
        }

        /* .btn {
            appearance: none;
            border: 0;
            border-radius: 14px;
            padding: 10px 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform .02s ease, opacity .2s ease;
            display: inline-flex;
            gap: 8px;
            align-items: center
        } */

        .btn:active {
            transform: translateY(1px)
        }

        .btn-primary {
            background: var(--accent);
            color: #06220f
        }

        .btn-success {
            background: var(--success);
            color: #ffffff;
            background-color: #033814
        }

        .btn-error {
            background: var(--error);
            color: #ffffff;
            background-color: #ca0000
        }

        .btn-outline {
            background: transparent;
            color: #cbd5e1;
            border: 1px solid #26324a
        }

        .btn-ghost {
            background: transparent;
            color: #94a3b8
        }

        .grid {
            display: grid;
            gap: 16px
        }

        @media(min-width:768px) {
            .grid-cols-3 {
                grid-template-columns: repeat(3, 1fr)
            }
        }

        .card {
            background: linear-gradient(180deg, #121a2b, #0f172a);
            border: 1px solid #1e293b;
            border-radius: 18px;
            padding: 16px
        }

        .card h3 {
            margin: 8px 0 0;
            font-size: 18px
        }

        .price {
            /* font-size: 28px; */
            font-weight: 800;
            margin: 8px 0
        }

        .muted {
            color: var(--muted)
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 999px;
            padding: 6px 10px;
            font-size: 12px;
            border: 1px solid #233149;
            background: #0f172a
        }

        .plans .card {
            position: relative;
            overflow: hidden
        }

        .plans .card.selected {
            outline: 2px solid var(--accent);
            box-shadow: 0 0 0 6px var(--ring)
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #26324a, transparent);
            margin: 16px 0
        }

        .footer {
            opacity: .75;
            font-size: 12px;
            margin-top: 24px
        }

        .stack {
            display: flex;
            flex-direction: column;
            gap: 12px
        }

        .row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap
        }

        .kpis {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(2, 1fr)
        }

        .kpi {
            background: #0e1628;
            border: 1px solid #22304a;
            border-radius: 14px;
            padding: 12px
        }

        .kpi strong {
            font-size: 16px
        }

        .notice {
            background: #0b1526;
            border: 1px dashed #1f2b45;
            border-radius: 14px;
            padding: 12px;
            color: #9fb4d0
        }

        .paywall {
            position: sticky;
            bottom: 12px;
            background: #0f172a;
            border: 1px solid #213049;
            border-radius: 16px;
            padding: 12px
        }

        .pay-btn {
            flex: 1
        }

        .provider {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #22304a;
            background: #0f172a;
            border-radius: 12px;
            padding: 10px;
            cursor: pointer
        }

        .provider.active {
            border: 2px solid #22c55e;
            border-color: var(--accent)
        }

        .toast {
            position: fixed;
            right: 10px;
            bottom: 10px;
            border-radius: 12px;
            padding: 10px;
            display: none
        }

        .hidden {
            display: none
        }

        input,
        select {
            width: 100%;
            background: #0f172a;
            border: 1px solid #22304a;
            border-radius: 12px;
            padding: 10px;
            color: #e5e7eb
        }

        .help {
            font-size: 12px;
            color: #9fb4d0
        }

        a {
            color: var(--accent-2);
            text-decoration: none
        }

        .m-2 {
            margin: 2px;
        }

        .error {
            color: red;
        }

        .loading {
            opacity: 0.5;
            pointer-events: none;
            cursor: not-allowed;
            animation: spin 1s linear infinite;
        }

        .disabled {
            opacity: 0.5;
            background-color: #1e293b;
            pointer-events: none;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    {{-- @dd($params['mac']) --}}
    <div class="container">
        <div class="nav">
            <div class="brand" id="logo"><img alt="wifi" onclick="toggleFullScreen()"
                    src="{{ asset('storage/logo/logo.png') }}" /><span>KINGALU
                    Wi-Fi</span>
            </div>
            <div class="lang">
                <button onclick="switchTo('sw')" class="btn btn-ghost"
                    {{ session('locale') == 'sw' ? 'style=font-weight:bold' : '' }}>SW</button>
                <button onclick="switchTo('en')" class="btn btn-ghost"
                    {{ session('locale') == 'en' ? 'style=font-weight:bold' : '' }}>EN</button>
            </div>
        </div>

        <div class="card ">
            <div class="step-card active" id="step-1">
                <div class="stack">
                    <div>
                        <h1 id="mainTitle" style="margin:0;font-size:28px;">{{ __('main.mainTitle') }}</h1>
                        {{-- <p class="text-center muted" id="subtitle">Pay quickly with mobile money. One device per plan.</p> --}}
                    </div>
                </div>
                <div class="divider"></div>
                <div class="plans" id="plans">
                    @foreach ($plans as $p)
                        <div class="card plan-card mt-2">
                            <div class="d-flex justify-content-between">
                                <span class="mt-2 name">{{ $p->name }}</span>
                                <span class="price">{{ number_format($p->price) }}TZS</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between px-2">
                                <div class="col">
                                    <span
                                        class="row duration">{{ $p->duration_minutes / 60 . ' ' . ($p->duration_minutes > 1 ? 'masaa' : 'dakika') }}</span>
                                    <span class="row speed_limit">{{ $p->speed_limit / 1024 }}Mbps</span>
                                </div>
                                <button class="btn btn-light select-plan"
                                    data-id="{{ $p->id }}">{{ __('Select') }}</button>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="divider"></div>
                <button class="btn btn-accent text-white text-center w-100" id="to-step-2">Next</button>
            </div>
            <!-- <div class="divider"></div> -->

            <div class="step-card" id="step-2">

                <div class="stack">
                    <label for="phone">Mobile number (M-Pesa/TigoPesa/Airtel Money)</label>
                    <input id="phone" inputmode="tel" maxlength="12"
                        onkeyup="validatePhone(document.getElementsByTagName('html')[0].getAttribute('lang'), this.value)"
                        placeholder="07XXXXXXXX" />
                    <span class="error" id="phoneError"></span>
                    <div class="help">We will send a payment prompt to this number after you pick a plan.</div>
                    <button class="btn btn-secondary w-100 mb-2" id="back-1">Back</button>
                    <button class="btn btn-accent text-white w-100" id="to-step-3">Next</button>
                </div>

            </div>

            <!-- <div class="divider"></div> -->

            <div class=" step-card" id="step-3">

                <div class="stack">
                    <div class="muted">Choose payment method</div>
                    <div class="row" id="providers">
                        <div class="provider" data-provider="mpesa"><img
                                src="data:image/jpeg;base64,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"
                                width="18" /><span>M-Pesa</span>
                        </div>
                        {{-- <div class="provider" data-provider="tigopesa"><img
                                src="data:image/png;base64,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"
                                width="18" /><span>TigoPesa</span>
                        </div>
                        <div class="provider" data-provider="airtel"><img
                                src="data:image/jpeg;base64,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"
                                width="18" /><span>Airtel
                                Money</span></div> --}}
                    </div>
                </div>

                <div class="paywall row" style="align-items:center;gap:10px">
                    <div class="badge"><span class="p-2" id="summary"></span></div>
                    <button class="btn btn-secondary w-100 mb-2" id="back-2">Back</button>
                    <button class="btn btn-primary pay-btn" id="payBtn">Pay & Connect</button>
                </div>

                <div class="footer">
                    <p>By continuing you agree to the <a href="#" id="termsLink">Terms</a>. Access is bound to one
                        device
                        (MAC). Fraud or sharing will lead to blocking.
                        <br />Support: +255 762 725 725 • SKYLINK SOLUTIONS
                    </p>
                </div>

            </div>
        </div>

    </div>
    <!-- Toast Notification id="toast, use bootstrap classes" -->
    <div id="toast" class="toast align-items-center text-bg-primary bg-danger text-white border-0" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toast-body">
                Hello, world! This is a toast message.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>

    {{-- hidden button to triger the toast modal --}}
    {{-- <button id="toastBtn" class="btn btn-primary" data-bs-toggle="toast" data-bs-target="#toast"
        style="display:none">Show
        Toast</button> --}}


    <script>
        $(document).ready(function() {
            // Initial setup
            // $('#toast').show();
            // setTimeout(() => $('#toast').hide(), 4000);
            let selectedPlan = null;
            const plans = @json($plans);
            //get params from backend injected by laravel though an array called $params
            // $params = [
            //     "res" => "notyet",
            //     "uamip" => "10.1.0.1",
            //     "uamport" => "3990",
            //     "challenge" => "02400a4e708af77f040e1f048ae425b4",
            //     "called" => "70-19-88-73-88-8B",
            //     "mac" => "F2-4C-2D-60-F3-8C",
            //     "ip" => "10.1.0.6",
            //     "nasid" => "myhotspot",
            //     "sessionid" => "175802826700000005",
            //     "userurl" => "http://connectivitycheck.gstatic.com/generate_204" 
            // ];
            //convert to json object
            let params = @json($params);
            // alert(params.res);
            let selectedProvider = null;
            let clientMac = null; // This should be set by the hotspot system
            let userLang = $('html').attr('lang');
            let client_mac = '2C:54:91:88:C9:E3';
            let phoneNumber = null;
            let isValidNumber = false;
            let polling = false;
            let pollInterval = null;
            let pollAttempts = 0;
            const maxPollAttempts = 15; // e.g., poll for a maximum of 15 times
            const pollDelay = 4000; // 4 seconds delay between polls
            let interactionDisabled = false;
            let isUnderMaintanance = false;

            $('#to-step-2').addClass('disabled');
            $('#payBtn').addClass('disabled');
            // $('#to-step-3').addClass('disabled');
            $('.select-plan').on('click', function() {
                let planId = $(this).data('id');
                // unselect all plans cards
                $('.plans .card').removeClass('selected');
                // select the clicked plan card
                $(this).closest('.card').addClass('selected');
                $('#to-step-2').removeClass('disabled');
                // store selected plan
                selectedPlan = planId;
                // updateSummary();
            });

            // Step navigation
            $("#to-step-2").on('click', function() {
                $("#step-1").removeClass("active");
                $("#step-2").addClass("active");
                $('#to-step-3').addClass('disabled');
            });

            $('#phone').on('input', function() {
                if (validatePhone(userLang, this.value)) {
                    phoneNumber = this.value;
                    isValidNumber = true;
                    $('#to-step-3').removeClass('disabled');
                } else {
                    phoneNumber = null;
                    isValidNumber = false;
                    $('#to-step-3').addClass('disabled');
                }
            });

            function fmtTZS(n) {
                return new Intl.NumberFormat('en-TZ', {
                    style: 'currency',
                    currency: 'TZS',
                    maximumFractionDigits: 0
                }).format(n);
            }

            function getQuery() {
                const query = window.location.search.substring(1);
                const vars = query.split("&");
                const queryParams = {};
                for (let i = 0; i < vars.length; i++) {
                    const pair = vars[i].split("=");
                    queryParams[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
                }
                return queryParams;
            }

            function toast(msg) {
                const t = $('#toast-body');
                t.text(msg);
                // trigger toast modal
                $('#toast').show();
                setTimeout(() => $('#toast').hide(), 4000);
            }

            function updateSummary() {
                $("#payBtn").addClass("disabled");
                $('#payBtn').removeClass('btn-primary');
                $('#payBtn').addClass('btn-secondary');
                // console.log({selectedPlan, selectedProvider, phoneNumber, client_mac, userLang});
                if ((selectedPlan != null) && (selectedProvider != null) && isValidNumber && (client_mac != null)) {
                    $('#payBtn').removeClass('btn-secondary');
                    $('#payBtn').addClass('btn-primary');
                    $('#payBtn').removeClass('disabled');
                    $("#payBtn").removeClass("disabled");

                    const plan = plans.find(p => p.id == selectedPlan);
                    // console.log(`${plan.name} - ${fmtTZS(plan.price)} via ${capitalize(selectedProvider || '...')}, Phone: ${phoneNumber || '...'}`);
                    $('#summary').text(
                        `${plan.name} - ${fmtTZS(plan.price)} \n ${capitalize(selectedProvider || '...')}, \n ${phoneNumber || '...'}`
                    );

                    // attach click event to pay button
                    $('#payBtn').off('click').on('click', function() {
                        startPayment();
                    });
                } else {
                    $('#payBtn').removeClass('btn-primary');
                    $('#payBtn').addClass('btn-secondary');
                    $('#payBtn').addClass('disabled');

                    // debuging all required values
                    if (selectedPlan == null) {
                        alert('No plan selected');
                    }
                    if (selectedProvider == null) {
                        alert('No provider selected');
                    }
                    if (!isValidNumber) {
                        alert('Invalid phone number');
                    }
                    if (client_mac == null) {
                        alert('No client MAC address');
                    }
                    $('#summary').text('Select plan, provider and enter phone number to proceed');

                }
            }

            async function startPayment() {

                if (isUnderMaintanance) {
                    alert(
                        'Asante kwa kutumia huduma zetu. Kwa sasa mfumo uko katika matengenezo. Tafadhali jaribu tena baadaye.'
                        ); // Thank you for using our services. The system is currently under maintenance. Please try again later.
                    // exit function
                    return;
                }
                // show loading
                var $payBtn = $('#payBtn');
                $payBtn.text('Loading…');
                $payBtn.removeClass('btn-primary');
                $payBtn.addClass('loading');
                $payBtn.prop('disabled', true);
                // disable interaction
                interactionDisabled = true;
                $('#back-2').hide();

                const payload = {
                    plan_id: selectedPlan,
                    provider: selectedProvider,
                    phone: phoneNumber,
                    lang: userLang,
                    uamip: params.uamip,
                    uamport: params.uamport,
                    challenge: params.challenge,
                    called: params.called,
                    mac: params.mac,
                    ip: params.ip,
                    nasid: params.nasid,
                    sessionid: params.sessionid,
                    userurl: params.userurl
                };

                // alert(payload.mac);

                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                try {
                    const response = await fetch('/payments/checkout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(payload)
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || 'Something went wrong.');
                    }

                    const data = await response.json();

                    if (!data.success) {
                        toast('Error here: ' + data.message);
                        throw new Error(data.message);
                    }

                    toast(data.message);
                    $('#toast').removeClass('bg-danger');
                    $('#toast').addClass('bg-success');
                    $payBtn.removeClass('loading');
                    $payBtn.addClass('disabled');
                    $payBtn.text('Waiting...');
                    $payBtn.addClass('btn-success');
                    $('#back-2').hide();
                    interactionDisabled = true;
                    polling = true;
                    pollStatus(data.checkout_id);
                } catch (e) {
                    interactionDisabled = false;
                    polling = false;
                    $payBtn.removeClass('loading');
                    $payBtn.prop('disabled', false);
                    $payBtn.text('Pay & Connect');
                    $('#toast').removeClass('bg-success');
                    $('#toast').addClass('bg-danger');
                    toast('Error: ' + e.message);
                } finally {
                    if (!polling)
                        $(".provider").removeClass("active");
                }
            }

            async function pollStatus(id) {
                const $payBtn = $('#payBtn');
                let attempts = 0;
                const maxAttempts = 15;

                const tick = async () => {
                    if (attempts >= maxAttempts) {
                        toast('Payment timeout. Please try again.');
                        $payBtn.prop('disabled', false).text('Pay & Connect').removeClass('btn-error');
                        polling = false;
                        interactionDisabled = false;
                        return;
                    }
                    attempts++;

                    try {
                        const r = await fetch(`/payments/checkout/${id}`);
                        if (!r.ok) return setTimeout(tick, 2000);

                        const j = await r.json();
                        if (j.status === 'successful') {
                            toast('Payment confirmed. Connecting device…');
                            $payBtn.text('Connecting...').addClass('btn-success').prop('disabled',
                            true);
                            polling = false;
                            setTimeout(() => window.location.href = j.redir || '/success', 1200);
                        } else if (j.status === 'failed') {
                            toast('Payment failed. Please try again.');
                            $payBtn.prop('disabled', false).text('Pay & Connect').removeClass(
                                'btn-success btn-error');
                            polling = false;
                        } else {
                            setTimeout(tick, 2000);
                        }
                    } catch (err) {
                        toast('Error: ' + err.message);
                        polling = false;
                    }
                };
                tick();
            }
            
            // capitalize first letter of a string
            function capitalize(str) {
                return str.toUpperCase();
            }

            $("#back-1").click(() => {
                $("#step-2").removeClass("active");
                $("#step-1").addClass("active");
            });
            $("#to-step-3").click(() => {
                $("#step-2").removeClass("active");
                $("#step-3").addClass("active");
            });
            $("#back-2").click(() => {
                $("#step-3").removeClass("active");
                $("#step-2").addClass("active");
            });

            // Step 3: provider select
            $(".provider").click(function() {
                // if paymenyt button is loading, do nothing
                if (polling || interactionDisabled) {
                    alert('Please wait...');
                    // exit function
                    return;
                } else {
                    $(".provider").removeClass("active");
                    $(this).addClass("active");
                    selectedProvider = $(this).data("provider");
                    updateSummary();
                }
            });

        });

        // validate phone number
        function validatePhone(lang, phone) {
            // if lang=sw use regex for tanzania, if lang=en use regex for international
            // alert(lang);

            const $ = s => document.querySelector(s);
            const $$ = s => Array.from(document.querySelectorAll(s));

            if (lang == 'sw') {
                if (/^(\+255|0)\d{9}$/.test(phone)) {
                    // $('#phoneError').textContent = 'Use Format: 07XXXXXXXXX';
                    $('#phoneError').textContent = '';
                    return true;
                } else {
                    $('#phoneError').textContent = 'Use Format: 07XXXXXXXXX';
                    return false;
                }
            }
            if (lang == 'en') {
                // $('#phoneError').textContent = 'Use Format: +255XXXXXXXXX';
                if (/^\+?\d{10,15}$/.test(phone)) {
                    $('#phoneError').textContent = '';
                    return true;
                } else {
                    $('#phoneError').textContent = 'Use Format: +255XXXXXXXXX';
                    return false;
                }
            }
        }

        function toggleFullScreen() {
            window.location.href = "/admin";
        }

        function switchTo(lang) {
            $.ajax({
                url: '/locale/' + lang,
                type: 'GET',
                success: function() {
                    // alert('Language switched to ' + lang);
                    location.reload();
                },
                error: function(xhr) {
                    console.error('Locale switch failed:', xhr);
                }
            });
        }
    </script>
    {{-- JQUERY LINK --}}
    <script src="{{ asset('assets/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVpZbVjU7a3qyKcTz6Ow1176Z8JzrV9qY7VvRvHJ87DkKw6f" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>

</body>

</html>
