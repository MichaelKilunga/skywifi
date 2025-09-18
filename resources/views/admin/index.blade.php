<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f0f2f5;
            }

            .card {
                border-radius: 12px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .card-title {
                color: #495057;
            }

            .card-number {
                font-size: 2.5rem;
                font-weight: bold;
                color: #007bff;
            }

            .card-link {
                font-size: 0.9rem;
                text-decoration: none;
                color: #6c757d;
            }
        </style>
    </head>

    <body>

        <div class="container py-5">
            <div class="justify-content-between m-2 d-flex">
                <h1 class="fw-bold text-center">Admin Dashboard</h1>
                <a class="btn hover:btn-danger" href="{{ route("admin.logout") }}"><i class="fas fa-sign-out-alt"></i>
                    Logout</a>
            </div>

            <!-- Dashboard Metrics Row -->
            <div class="row g-4 justify-content-center">

                <!-- Total Connected Devices Card -->
                <div class="col-md-5">
                    <div class="card h-100 p-4 text-center">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-phone fa-3x text-success mb-3"></i>
                            <h5 class="card-title text-uppercase">Total Devices</h5>
                            <p class="card-number" id="totalDevices">{{ $devices }}</p>
                            <a class="card-link mt-auto" href="{{ route("admin.devices.index") }}">View All Devices <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Total Connected Devices Card -->
                <div class="col-md-5">
                    <div class="card h-100 p-4 text-center">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-signal fa-3x text-success mb-3"></i>
                            <h5 class="card-title text-uppercase">Total Active Devices</h5>
                            <p class="card-number" id="totalActiveDevices">{{ $activeDevices }}</p>
                            <a class="card-link mt-auto" href="{{ route("admin.devices.index") }}">View All Devices <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Total Subscriptions Card -->
                <div class="col-md-5">
                    <div class="card h-100 p-4 text-center">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-users fa-3x text-info mb-3"></i>
                            <h5 class="card-title text-uppercase">Total Subscriptions</h5>
                            <p class="card-number" id="totalSubscriptions">{{ $subscriptions }}</p>
                            <a class="card-link mt-auto" href="{{ route("admin.subscriptions.index") }}">View All
                                Subscriptions <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Total Inactive Devices Card -->
                <div class="col-md-5">
                    <div class="card h-100 p-4 text-center">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-users fa-3x text-success mb-3"></i>
                            <h5 class="card-title text-uppercase">Total Active Subscriptions</h5>
                            <p class="card-number" id="totalConnectedDevices">{{ $activeSubscriptions }}</p>
                            <a class="card-link mt-auto" href="{{ route("admin.subscriptions.index") }}">View All
                                Subscriptions <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Plan Management Card -->
                <div class="col-md-5">
                    <div class="card h-100 p-4 text-center">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-gear fa-3x text-success mb-3"></i>
                            <h5 class="card-title text-uppercase">Subscriptions Plans</h5>
                            <p class="card-number" id="totalConnectedDevices">{{ $activeSubscriptions }}</p>
                            <a class="card-link mt-auto" href="{{ route("admin.plans.index") }}">View All Plans <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="{{asset('bootstrap.bundle.min.js')}}"></script> 
    <script src="{{asset('assets/jquery-3.6.0.min.js')}}"></script> --}}
        {{-- <script>
        // --- This script simulates fetching data from your backend ---
        document.addEventListener('DOMContentLoaded', () => {
            // Placeholder data, this would be replaced by a real API call in a live app
            const dashboardData = {
                totalSubscriptions: {{ $activeSubscriptions }},
                totalConnectedDevices: {{ $activeDevices }}
            };

            // Update the dashboard with the simulated data
            document.getElementById('totalSubscriptions').textContent = dashboardData.totalSubscriptions;
            document.getElementById('totalConnectedDevices').textContent = dashboardData.totalConnectedDevices;

            // In a real application, the links would navigate to specific pages.
            // For example:
            // document.getElementById('subscriptionsLink').href = '/subscriptions';
            // document.getElementById('devicesLink').href = '/devices';
        });
    </script> --}}
    </body>

</html>
