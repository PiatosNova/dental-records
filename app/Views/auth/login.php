<!DOCTYPE html>
<html>
<head>
    <title>Login - Dental Appointment</title>
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
        .auth-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .auth-card .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            padding: 1rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.6rem 1rem;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(0,112,186,0.1);
            border-color: #0070ba;
        }
        .btn-primary {
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="welcome-banner text-center">
        <div class="container">
            <h1 class="display-5 mb-2">Dental Appointment</h1>
            <p class="lead mb-0">Sign in to manage your dental appointments</p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card auth-card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Sign In
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle me-2"></i>
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= base_url('auth/authenticate') ?>" method="post">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" required 
                                           placeholder="Enter your email">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" required 
                                           placeholder="Enter your password">
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Sign In
                                </button>
                                <div class="text-center mt-3">
                                    Don't have an account? 
                                    <a href="<?= base_url('auth/register') ?>" class="text-decoration-none">
                                        Create one here
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Optional: Add some information or contact details -->
                <div class="text-center mt-4 text-muted">
                    <small>
                        <i class="bi bi-clock me-1"></i>
                        Business Hours: Mon-Fri 9:00 AM - 5:00 PM
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 