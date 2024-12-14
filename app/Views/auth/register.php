<!DOCTYPE html>
<html>
<head>
    <title>Register - Dental Appointment</title>
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
            <p class="lead mb-0">Create your account to manage dental appointments</p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card auth-card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="bi bi-person-plus me-2"></i>
                            Register Account
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if (session()->has('errors')) : ?>
                            <div class="alert alert-danger">
                                <?php foreach (session('errors') as $error) : ?>
                                    <?= $error ?><br>
                                <?php endforeach ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= base_url('auth/store') ?>" method="post">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control" required value="<?= old('name') ?>" placeholder="Enter your full name">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" required value="<?= old('email') ?>" placeholder="Enter your email">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" required placeholder="Create a password">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="password" name="confirm_password" class="form-control" required placeholder="Confirm your password">
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-person-plus-fill me-2"></i>
                                    Create Account
                                </button>
                                <div class="text-center mt-3">
                                    Already have an account? 
                                    <a href="<?= base_url('auth/login') ?>" class="text-decoration-none">
                                        Sign in here
                                    </a>
                                </div>
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