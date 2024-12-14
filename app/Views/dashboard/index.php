<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fa;
        }
        .welcome-banner {
            background: linear-gradient(135deg, #0070ba, #1546a0);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        .quick-actions .btn {
            text-align: left;
            padding: 1rem;
            margin-bottom: 0.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .quick-actions .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .quick-actions .btn i {
            font-size: 1.5rem;
            margin-right: 1rem;
        }
        .stats-card {
            background: white;
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .service-item {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        .service-item:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .service-item i {
            color: #0070ba;
            font-size: 1.5rem;
        }
        .upcoming-appointment {
            background: #f5f8fe;
            border-left: 4px solid #0070ba;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0 10px 10px 0;
        }
    </style>
</head>
<body>
    <?= view('templates/navbar') ?>

    <div class="welcome-banner">
        <div class="container">
            <h1 class="mb-2">Welcome back, <?= esc(session()->get('name')) ?>!</h1>
            <p class="mb-0">Manage your dental appointments and services</p>
        </div>
    </div>

    <div class="container">
        <!-- Quick Actions and Stats Row -->
        <div class="row mb-4">
            <!-- Quick Actions -->
            <div class="col-md-8 quick-actions">
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?= base_url('appointments/create') ?>" class="btn btn-primary w-100">
                            <i class="bi bi-calendar-plus"></i>
                            <div>
                                <strong>Book Appointment</strong>
                                <div class="small">Schedule your next dental visit</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('appointments') ?>" class="btn btn-light w-100">
                            <i class="bi bi-calendar-week"></i>
                            <div>
                                <strong>View Appointments</strong>
                                <div class="small">Check your scheduled visits</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 mt-3">
                        <?php if (session()->get('isAdmin')): ?>
                            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-dark w-100">
                                <i class="bi bi-shield-lock"></i>
                                <div>
                                    <strong>Admin Dashboard</strong>
                                    <div class="small">Manage clinic operations</div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-body">
                        <h6 class="text-muted mb-3">Clinic Hours Today</h6>
                        <?php 
                        $today = strtolower(date('l'));
                        if ($today == 'sunday'): ?>
                            <p class="mb-0 text-danger">Closed Today</p>
                        <?php elseif ($today == 'saturday'): ?>
                            <p class="mb-0">9:00 AM - 2:00 PM</p>
                        <?php else: ?>
                            <p class="mb-0">9:00 AM - 5:00 PM</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Row -->
        <div class="row">
            <!-- Services Section -->
            <div class="col-md-8 mb-4">
                <h5 class="mb-3">Our Services</h5>
                <div class="row">
                    <?php 
                    $services = [
                        ['icon' => 'bi-clipboard2-pulse', 'name' => 'Dental Checkup', 'desc' => 'Comprehensive oral examination'],
                        ['icon' => 'bi-brush', 'name' => 'Teeth Cleaning', 'desc' => 'Professional dental cleaning'],
                        ['icon' => 'bi-tools', 'name' => 'Tooth Extraction', 'desc' => 'Safe and gentle extraction'],
                        ['icon' => 'bi-lightning', 'name' => 'Root Canal', 'desc' => 'Advanced endodontic treatment'],
                        ['icon' => 'bi-circle-square', 'name' => 'Dental Filling', 'desc' => 'Restore damaged teeth'],
                        ['icon' => 'bi-brightness-high', 'name' => 'Teeth Whitening', 'desc' => 'Professional whitening service']
                    ];
                    foreach ($services as $service): ?>
                    <div class="col-md-6">
                        <div class="service-item">
                            <div class="d-flex align-items-center">
                                <i class="bi <?= $service['icon'] ?> me-3"></i>
                                <div>
                                    <h6 class="mb-1"><?= $service['name'] ?></h6>
                                    <small class="text-muted"><?= $service['desc'] ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Side Panel -->
            <div class="col-md-4">
                <!-- Profile Card -->
                <div class="card stats-card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 48px; height: 48px;">
                                <i class="bi bi-person-fill text-white fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1"><?= esc(session()->get('name')) ?></h6>
                                <small class="text-muted"><?= esc(session()->get('email')) ?></small>
                            </div>
                        </div>
                        <div class="border-top pt-3">
                            <small class="text-muted">Member since</small>
                            <div><?= date('F Y') ?></div>
                        </div>
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="card stats-card">
                    <div class="card-body">
                        <h6 class="mb-3">Clinic Hours</h6>
                        <div class="mb-2">
                            <small class="text-muted d-block">Monday - Friday</small>
                            <div>9:00 AM - 5:00 PM</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted d-block">Saturday</small>
                            <div>9:00 AM - 2:00 PM</div>
                        </div>
                        <div>
                            <small class="text-muted d-block">Sunday</small>
                            <div>Closed</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 