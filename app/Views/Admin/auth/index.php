<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-sm border-0 rounded-3" style="width: 100%; max-width: 420px;">

        <div class="card-body p-4">

            <!-- Logo -->
            <div class="text-center">
                <img src="<?= BASE_URL ?>/assets/images/logo.png"
                     alt="Logo"
                     class="img-fluid"
                     style="max-width: 150px;">
            </div>

            <!-- Heading -->
            <h4 class="text-center fw-semibold mb-1">Admin Login</h4>
            <p class="text-center text-muted mb-4">
                Enter your credentials to continue
            </p>

            <!-- Error Message -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center py-2" id="loginAlert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="post" action="<?= BASE_URL ?>/admin/login/store">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope-fill"></i>
                        </span>
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="Enter email"
                               required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Enter password"
                               required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary fw-semibold">
                        Login
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
<script>
    const alertBox = document.getElementById('loginAlert');
    if (alertBox) {
        setTimeout(() => {
            alertBox.classList.add('fade');
            setTimeout(() => alertBox.remove(), 500);
        }, 3000);
    }
</script>
 