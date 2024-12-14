<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f7f9fa; }
        .stats-card {
            background: white;
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <?= view('templates/navbar') ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Admin Dashboard</h2>
            <a href="<?= base_url('admin/appointments') ?>" class="btn btn-primary">
                <i class="bi bi-calendar-check"></i> Manage Appointments
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card card mb-3">
                    <div class="card-body">
                        <h3 class="display-4 mb-2"><?= $total_appointments ?></h3>
                        <div class="text-muted">Total Appointments</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card card mb-3">
                    <div class="card-body">
                        <h3 class="display-4 mb-2"><?= $pending_appointments ?></h3>
                        <div class="text-muted">Pending Appointments</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card card mb-3">
                    <div class="card-body">
                        <h3 class="display-4 mb-2"><?= $total_users ?></h3>
                        <div class="text-muted">Registered Users</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Appointments -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Appointments</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Service</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_appointments as $appointment): ?>
                            <tr>
                                <td><?= esc($appointment['patient_name']) ?></td>
                                <td><?= esc($appointment['service']) ?></td>
                                <td>
                                    <?= date('M d, Y', strtotime($appointment['appointment_date'])) ?>
                                    <br>
                                    <small class="text-muted">
                                        <?= date('h:i A', strtotime($appointment['appointment_time'])) ?>
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-<?= $appointment['status'] == 'confirmed' ? 'success' : ($appointment['status'] == 'cancelled' ? 'danger' : 'warning') ?>">
                                        <?= ucfirst($appointment['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <form action="<?= base_url('admin/appointments/update-status/' . $appointment['id']) ?>" method="post" class="d-inline">
                                        <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                            <option value="pending" <?= $appointment['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="confirmed" <?= $appointment['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                            <option value="cancelled" <?= $appointment['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 