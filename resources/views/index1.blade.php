<!doctype html>
<html lang="sw">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="{{ csrf_token() }}" name="csrf-token">
        <title>KINGALU Wi-Fi | Connect & Pay</title>

        {{-- Google Fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        {{-- jQuery --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <style>
            body {
                font-family: Inter, system-ui, sans-serif;
                background: linear-gradient(180deg, #0b1220, #0b1220 40%, #0f172a 100%) fixed;
                color: #e5e7eb;
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

            .provider {
                cursor: pointer;
            }

            .provider.active {
                border: 2px solid #22c55e;
            }
        </style>
    </head>

    <body>
        <pre>
            sudo apt update && sudo apt upgrade -y
            sudo apt install -y freeradius freeradius-mysql nginx git curl net-tools iptables-utils
        </pre>
    </body>

</html>
