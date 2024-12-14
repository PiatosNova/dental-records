<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?= view('templates/navbar') ?>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Book an Appointment</h4>
                    </div>
                    <div class="card-body">
                        <?php if (session()->has('errors')) : ?>
                            <div class="alert alert-danger">
                                <?php foreach (session('errors') as $error) : ?>
                                    <?= $error ?><br>
                                <?php endforeach ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('appointments/store') ?>" method="post">
                            <div class="mb-3">
                                <label>Service</label>
                                <select name="service" class="form-select" required>
                                    <option value="">Select a service</option>
                                    <?php foreach ($services as $service) : ?>
                                        <option value="<?= $service ?>" <?= old('service') == $service ? 'selected' : '' ?>>
                                            <?= $service ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Appointment Date</label>
                                <input type="date" name="appointment_date" class="form-control" 
                                       min="<?= date('Y-m-d') ?>" 
                                       value="<?= old('appointment_date') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label>Appointment Time</label>
                                <input type="time" name="appointment_time" class="form-control" 
                                       min="09:00" max="17:00" 
                                       value="<?= old('appointment_time') ?>" required>
                                <small class="text-muted">Business hours: 9:00 AM - 5:00 PM</small>
                            </div>

                            <div class="mb-3">
                                <label>Notes (Optional)</label>
                                <textarea name="notes" class="form-control" rows="3"><?= old('notes') ?></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Book Appointment</button>
                                <a href="<?= base_url('appointments') ?>" class="btn btn-light">Cancel</a>
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