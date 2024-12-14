<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?= view('templates/navbar') ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>My Appointments</h2>
            <a href="<?= base_url('appointments/create') ?>" class="btn btn-primary">Book New Appointment</a>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <?php if (empty($appointments)) : ?>
                    <p class="text-center">No appointments found.</p>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appointments as $appointment) : ?>
                                    <tr>
                                        <td><?= esc($appointment['service']) ?></td>
                                        <td><?= date('M d, Y', strtotime($appointment['appointment_date'])) ?></td>
                                        <td><?= date('h:i A', strtotime($appointment['appointment_time'])) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $appointment['status'] == 'confirmed' ? 'success' : ($appointment['status'] == 'cancelled' ? 'danger' : 'warning') ?>">
                                                <?= ucfirst($appointment['status']) ?>
                                            </span>
                                        </td>
                                        <td><?= esc($appointment['notes']) ?></td>
                                        <td>
                                            <?php if ($appointment['status'] == 'pending') : ?>
                                                <a href="<?= base_url('appointments/cancel/' . $appointment['id']) ?>" 
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                                    Cancel
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 