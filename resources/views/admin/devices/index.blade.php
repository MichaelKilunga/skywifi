<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Device Management</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/v4-shims.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        
    {{-- <link rel="stylesheet" href="{{asset('assets/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/bootstrap-icons.css')}}" />
    <link href="{{asset('assets/font-awesome.min.css')}}" rel="stylesheet"> --}}

        <style>
            /* Custom styles can be added here if needed, but Bootstrap covers most things */
            body {
                background-color: #f8f9fa;
                font-family: 'Inter', sans-serif;
            }

            .table-responsive {
                border-radius: 0.5rem;
            }
        </style>

    </head>

    <body>

        <div class="container-fluid p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-gray-800">Device Management</h1>
                <div>
                    {{-- view connected devices --}}
                    <a class="btn btn-primary" href="{{ route("admin.plans.index") }}"><i class="fas fa-phone"></i>
                        Plans</a>
                    <a class="btn btn-primary" href="{{ route("admin.dashboard") }}"><i class="fa fa-home"></i></a>
                </div>
            </div>

            @if (session("success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session("success") }}
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                </div>
            @endif

            <div class="card mb-4 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table-striped table-hover mb-0 table">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">Device Name</th>
                                    <th class="px-4 py-3">MAC Address</th>
                                    <th class="px-4 py-3">Current Plan</th>
                                    <th class="px-4 py-3">Subscription Status</th>
                                    <th class="px-4 py-3">Remain time</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr> 
                            </thead>
                            <tbody>
                                @foreach ($devices as $device)
                                    <tr class="@if ($device->deleted_at) table-secondary opacity-75 @endif">
                                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3">{{ $device->device_name?? "N/A" }}</td>
                                        <td class="px-4 py-3">{{ $device->mac_address }}</td>
                                        <td class="px-4 py-3">
                                                {{ $device->subscriptions()->latest()->first()->plan->name }}
                                        </td>
                                        <td class="px-4 py-3"> 
                                            {{$device
                                                ->subscriptions()
                                                ->latest("created_at")
                                                ->first()
                                                ->status;}}
                                        </td>
                                        <td class="px-4 py-3">{{ Carbon\Carbon::parse($device->latestSubscription()->end_time)->diffForHumans() }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="d-flex justify-content-center flex-wrap gap-2">
                                                <!-- Block/Unblock Form -->
                                                <form action="{{ route("admin.devices.block", $device) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-secondary" type="submit">
                                                        <i class="fas fa-ban"></i> {{ $device->deleted_at ? "Unblock" : "Block" }}
                                                    </button>
                                                </form>

                                                @if ($device->latestSubscription())
                                                    <!-- Deactivate/Activate Subscription Form -->
                                                    <form
                                                        action="{{ route("admin.subscriptions.manually-toggle-status", $device->latestSubscription()) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button class="btn btn-sm {{ $device->latestSubscription()->status === "active" ? "btn-danger" : "btn-success" }} text-white" type="submit">
                                                           <i class="fas fa-toggle-{{ $device->latestSubscription()->status === "active" ? "off" : "on" }}"></i> {{ $device->latestSubscription()->status === "active" ? "Deactivate" : "Activate" }}
                                                        </button>
                                                    </form>
                                                @endif

                                                <!-- Delete Device Button -->
                                                <button class="btn btn-sm btn-danger" data-bs-target="#deleteModal"
                                                    data-bs-toggle="modal" data-device-id="{{ $device->id }}"
                                                    type="button">
                                                    <i class="fas fa-trash-alt"></i> 
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $devices->links() }}
            </div>

            <!-- Delete Confirmation Modal -->
            <div aria-hidden="true" aria-labelledby="deleteModalLabel" class="modal fade" id="deleteModal"
                tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                                type="button"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to permanently delete this device? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                            <form class="d-inline" id="deleteForm" method="POST">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVpZbVjU7a3qyKcTz6Ow1176Z8JzrV9qY7VvRvHJ87DkKw6f" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
        </script>

        <script>
            // JavaScript to update the form action when the modal is shown
            var deleteModal = document.getElementById('deleteModal')
            deleteModal.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                var button = event.relatedTarget
                // Extract info from data-bs-* attributes
                var deviceId = button.getAttribute('data-device-id')
                // Update the form's action URL
                var form = document.getElementById('deleteForm')
                    form.action = `/admin/devices/${deviceId}`
            })
        </script>

    </body>

</html>
