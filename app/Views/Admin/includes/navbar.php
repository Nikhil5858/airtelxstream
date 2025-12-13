<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirtelXstream-Admin</title>

    <link rel="icon" type="image/png" href="<?= BASE_URL ?>/assets-admin/image/xsteamplay.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Correct CSS path -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets-admin/css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-3">

    <button class="btn btn-outline-secondary d-lg-none me-3" id="menu-toggle">
        <i class="bi bi-list" style="font-size: 1.6rem;"></i>
    </button>

    <h3 class="mb-0">AirtelXstream</h3>

    <ul class="navbar-nav ms-auto align-items-center">

        <li class="nav-item d-flex align-items-center me-3">
            <div class="profile-circle me-2">AD</div>
            <span class="fw-semibold">Admin User</span>
        </li>

        <li class="nav-item">
            <form method="post" action="<?= BASE_URL ?>/admin/logout" class="m-0">
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </li>

    </ul>

</nav>




<script src="<?= BASE_URL ?>/assets-admin/js/main.js"></script>
<script src="<?= BASE_URL ?>/assets-admin/js/validation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
