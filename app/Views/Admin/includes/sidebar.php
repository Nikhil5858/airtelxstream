<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <img type="image/png"  class="sidebar-logo me-2">
        <h5></h5>
    </div>
</div>

<div class="sidebar" id="sidebar">

    <div class="sidebar-brand d-flex align-items-center">
        <img src="<?php echo BASE_URL; ?>/assets/images/logo.png" alt="Logo" class="sidebar-logo ms-5">
    </div>

    <ul class="nav flex-column">
        <li><a href="<?= ADMIN_URL ?>/dashboard" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
        <li><a href="<?= ADMIN_URL ?>/movies" class="nav-link"><i class="bi bi-film"></i> Movies</a></li>
        <li><a href="<?= ADMIN_URL ?>/shows" class="nav-link"><i class="bi bi-tv"></i> Shows</a></li>
        <li><a href="<?= ADMIN_URL ?>/episodes" class="nav-link"><i class="bi bi-collection-play"></i> Episodes</a></li>
        <li><a href="<?= ADMIN_URL ?>/ott" class="nav-link"><i class="bi bi-app-indicator"></i> OTT Providers</a></li>
        <li><a href="<?= ADMIN_URL ?>/genres" class="nav-link"><i class="bi bi-tags"></i> Genres</a></li>
        <li><a href="<?= ADMIN_URL ?>/users" class="nav-link"><i class="bi bi-people"></i> Users</a></li>
        <li><a href="<?= ADMIN_URL ?>/subscriptions" class="nav-link"><i class="bi bi-cash-stack"></i> Subscriptions</a></li>
    </ul>
    
</div>

<!-- Overlay for mobile -->
<div id="overlay"></div>
