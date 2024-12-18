<!DOCTYPE html>
<html>
<head>
    <title>My Appointments</title>
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
            <h2>My Appointments</h2>
            <a href="<?= base_url('appointments/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> New Appointment
            </a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="card appointment-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
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
                                            <?php if ($appointment['status'] != 'cancelled'): ?>
                                                <a href="<?= base_url('appointments/edit/' . $appointment['id']) ?>" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <button type="button" class="btn btn-sm btn-warning" 
                                                        onclick="confirmCancel(<?= $appointment['id'] ?>)">
                                                    <i class="bi bi-x-circle"></i> Cancel
                                                </button>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    onclick="confirmDelete(<?= $appointment['id'] ?>)">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No appointments found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmCancel(id) {
            if (confirm('Are you sure you want to cancel this appointment?')) {
                window.location.href = '<?= base_url('appointments/cancel/') ?>/' + id;
            }
        }

        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this appointment? This action cannot be undone.')) {
                window.location.href = '<?= base_url('appointments/delete/') ?>/' + id;
            }
        }
    </script>
</body>
</html> 