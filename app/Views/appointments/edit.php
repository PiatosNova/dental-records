<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <?= view('templates/navbar') ?>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Appointment</h4>
                    </div>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('appointments/update/' . $appointment['id']) ?>" method="post">
                            <div class="mb-3">
                                <label for="service" class="form-label">Service</label>
                                <select name="service" id="service" class="form-select" required>
                                    <option value="">Select a service</option>
                                    <option value="Dental Checkup" <?= $appointment['service'] == 'Dental Checkup' ? 'selected' : '' ?>>
                                        Dental Checkup
                                    </option>
                                    <option value="Teeth Cleaning" <?= $appointment['service'] == 'Teeth Cleaning' ? 'selected' : '' ?>>
                                        Teeth Cleaning
                                    </option>
                                    <option value="Tooth Extraction" <?= $appointment['service'] == 'Tooth Extraction' ? 'selected' : '' ?>>
                                        Tooth Extraction
                                    </option>
                                    <option value="Root Canal" <?= $appointment['service'] == 'Root Canal' ? 'selected' : '' ?>>
                                        Root Canal
                                    </option>
                                    <option value="Dental Filling" <?= $appointment['service'] == 'Dental Filling' ? 'selected' : '' ?>>
                                        Dental Filling
                                    </option>
                                    <option value="Teeth Whitening" <?= $appointment['service'] == 'Teeth Whitening' ? 'selected' : '' ?>>
                                        Teeth Whitening
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="appointment_date" class="form-label">Appointment Date</label>
                                <input type="date" class="form-control" id="appointment_date" name="appointment_date" 
                                       value="<?= $appointment['appointment_date'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="appointment_time" class="form-label">Appointment Time</label>
                                <input type="time" class="form-control" id="appointment_time" name="appointment_time" 
                                       value="<?= $appointment['appointment_time'] ?>" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Update Appointment</button>
                                <a href="<?= base_url('appointments') ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 