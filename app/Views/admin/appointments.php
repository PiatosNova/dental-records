<!DOCTYPE html>
<html>
<head>
    <title>Admin - Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f7f9fa; }
        .appointment-card {
            background: white;
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <?= view('templates/navbar') ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manage Appointments</h2>
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <div class="card appointment-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($appointments) && !empty($appointments)): ?>
                                <?php foreach ($appointments as $appointment): ?>
                                    <tr>
                                        <td><?= esc($appointment['patient_name']) ?></td>
                                        <td><?= esc($appointment['service']) ?></td>
                                        <td><?= date('M d, Y', strtotime($appointment['appointment_date'])) ?></td>
                                        <td><?= date('h:i A', strtotime($appointment['appointment_time'])) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $appointment['status'] == 'confirmed' ? 'success' : 
                                                ($appointment['status'] == 'cancelled' ? 'danger' : 'warning') ?>">
                                                <?= ucfirst($appointment['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <form action="<?= base_url('admin/appointments/update-status/' . $appointment['id']) ?>" 
                                                  method="post" class="d-inline">
                                                <select name="status" class="form-select form-select-sm d-inline-block w-auto" 
                                                        onchange="this.form.submit()">
                                                    <option value="pending" <?= $appointment['status'] == 'pending' ? 'selected' : '' ?>>
                                                        Pending
                                                    </option>
                                                    <option value="confirmed" <?= $appointment['status'] == 'confirmed' ? 'selected' : '' ?>>
                                                        Confirmed
                                                    </option>
                                                    <option value="cancelled" <?= $appointment['status'] == 'cancelled' ? 'selected' : '' ?>>
                                                        Cancelled
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No appointments found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 