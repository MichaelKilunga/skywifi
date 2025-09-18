<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Choose Internet Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        .card-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
        }

        /* Highly specific override to force the modal to appear correctly */
        #editPlanModal .modal-dialog {
            z-index: 1051;
            /* Prevents the modal from being pushed off-screen */
            transform: none !important; 
            top: 50%;
            transform: translateY(-50%);
            margin: auto;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold">Welcome to SkyWiFi</h1>
                <p class="text-muted">Select a plan to get connected</p>
            </div>
            <div>
                <button class="btn btn-success me-2" data-bs-target="#addPlanModal" data-bs-toggle="modal">
                    <i class="fas fa-plus-circle"></i> Add New Plan
                </button>
                <a href="{{ route('admin.devices.index') }}" class="btn btn-primary"><i class="fas fa-phone"></i> Devices</a> 
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary"><i class="fas fa-home"></i></a>
            </div>
        </div>

        <div class="row">
            @foreach ($plans as $plan)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 position-relative shadow-sm">
                        <div class="card-body d-flex flex-column text-center">

                            {{-- Edit/Delete Actions --}}
                            <div class="card-actions">
                                {{-- delete button --}}
                                <form action="{{ route('plans.destroy', $plan->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this plan?')"
                                        title="Delete Plan">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                                {{-- Pass plan data to the button --}}
                                <button class="btn btn-sm btn-outline-primary edit-plan-btn" data-bs-target="#editPlanModal{{ $plan->id }}"
                                    data-bs-toggle="modal" data-id="{{ $plan->id }}" data-name="{{ $plan->name }}"
                                    data-duration="{{ $plan->duration_minutes }}" data-speed="{{ $plan->speed_limit }}"
                                    data-price="{{ $plan->price }}" data-status="{{ $plan->status }}"
                                    title="Edit Plan">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </div>

                            <h4 class="mt-4">{{ $plan->name }}</h4>
                            <p class="text-muted">
                                Duration: {{ $plan->duration_minutes }} min<br>
                                Speed: {{ $plan->speed_limit }} kbps
                            </p>
                            <h5 class="fw-bold mt-auto">{{ number_format($plan->price) }} TZS</h5>

                            <form action="{{ route('portal.activate', $plan->id) }}" class="mt-3" method="POST">
                                @csrf
                                <a href="{{ route('portal.activate', $plan->id) }}"
                                    class="btn {{ $plan->status == 'active' ? 'btn-danger' : 'btn-primary' }} w-100">{{ $plan->status == 'active' ? 'Deactivate' : 'Activate' }}</a>
                            </form>
                        </div>
                    </div>
                </div>

                 {{-- Edit Plan Modal --}}
    <div aria-hidden="true" aria-labelledby="editPlanModalLabel{{ $plan->id }}" class="modal fade" id="editPlanModal{{$plan->id}}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPlanModalLabel{{ $plan->id }}">Edit Plan</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('plans.edit', $plan->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Use PUT or PATCH for updates --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="edit-name">Plan Name</label>
                                    <input class="form-control" id="edit-name" name="name" value="{{ $plan->name }}" required type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="edit-duration_minutes">Duration
                                        (minutes)</label>
                                    <input class="form-control" id="edit-duration_minutes" name="duration_minutes"  value="{{ $plan->duration_minutes }}" required type="number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="edit-speed_limit">Speed Limit (Mbps)</label>
                                    <input class="form-control" id="edit-speed_limit" name="speed_limit" required value="{{ $plan->speed_limit }}"
                                        type="number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="edit-price">Price (TZS)</label>
                                    <input class="form-control" id="edit-price" name="price" required value="{{ $plan->price }}"
                                        type="number">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit-status">Status</label>
                            <select class="form-control" id="edit-status" name="status" required>
                                <option {{ $plan->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                                <option {{ $plan->status == 'inactive' ? 'selected' : '' }} value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                            <button class="btn btn-primary" type="submit">Update Plan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

            @endforeach
        </div>
    </div>

    {{-- Add Plan Modal --}}
    <div aria-hidden="true" aria-labelledby="addPlanModalLabel" class="modal fade" id="addPlanModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlanModalLabel">Add New Plan</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('plans.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Plan Name</label>
                                    <input class="form-control" id="name" name="name" required type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="duration_minutes">Duration (minutes)</label>
                                    <input class="form-control" id="duration_minutes" name="duration_minutes" required
                                        type="number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="speed_limit">Speed Limit (Mbps)</label>
                                    <input class="form-control" id="speed_limit" name="speed_limit" required
                                        type="number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="price">Price (TZS)</label>
                                    <input class="form-control" id="price" name="price" required type="number">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                            <button class="btn btn-primary" type="submit">Add Plan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editPlanModal = document.getElementById('editPlanModal');
            const editPlanForm = document.getElementById('editPlanForm');

            editPlanModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;

                const planId = button.getAttribute('data-id');
                const planName = button.getAttribute('data-name');
                const planDuration = button.getAttribute('data-duration');
                const planSpeed = button.getAttribute('data-speed');
                const planPrice = button.getAttribute('data-price');
                const planStatus = button.getAttribute('data-status');

                if (planId) {
                    editPlanForm.action = `/plans/${planId}`;
                    editPlanForm.querySelector('#edit-name').value = planName;
                    editPlanForm.querySelector('#edit-duration_minutes').value = planDuration;
                    editPlanForm.querySelector('#edit-speed_limit').value = planSpeed;
                    editPlanForm.querySelector('#edit-price').value = planPrice;
                    editPlanForm.querySelector('#edit-status').value = planStatus;
                }
            });
        });
    </script>
</body>

</html>