<div class="sidebar" id="sidebar">

    <div class="sidebar-brand d-flex justify-content-center">
        <img src="<?= BASE_URL ?>/assets/images/logo.png"
             alt="Logo"
             class="sidebar-logo">
    </div>

    <ul class="nav flex-column">
        <li><a href="<?= ADMIN_URL ?>/dashboard" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
        <li><a href="<?= ADMIN_URL ?>/movies" class="nav-link"><i class="bi bi-film"></i> Movies</a></li>
        <li><a href="<?= ADMIN_URL ?>/homepage_sections" class="nav-link">
            <i class="bi bi-layout-text-window-reverse"></i> Homepage Sections
        </a></li>

        <li><a href="<?= ADMIN_URL ?>/seasons" class="nav-link"><i class="bi bi-tv"></i> Season</a></li>
        <li><a href="<?= ADMIN_URL ?>/episodes" class="nav-link"><i class="bi bi-collection-play"></i> Episodes</a></li>
        <li><a href="<?= ADMIN_URL ?>/ott" class="nav-link"><i class="bi bi-app-indicator"></i> OTT Providers</a></li>
        <li><a href="<?= ADMIN_URL ?>/genres" class="nav-link"><i class="bi bi-tags"></i> Genres</a></li>
        <li><a href="<?= ADMIN_URL ?>/users" class="nav-link"><i class="bi bi-people"></i> Users</a></li>
        <li><a href="<?= ADMIN_URL ?>/subscription" class="nav-link"><i class="bi bi-cash-stack"></i> Subscriptions</a></li>

        <li class="nav-item">
            <a  href="javascript:void(0)"
                role="button"
                class="nav-link d-flex justify-content-between align-items-center"
                data-bs-toggle="collapse"
                data-bs-target="#castMenu"
                aria-expanded="false">

                <span>
                    <i class="bi bi-people me-2"></i> Cast
                </span>

                <i class="bi bi-chevron-down small"></i>
            </a>

            <ul class="collapse nav flex-column ms-3" id="castMenu">
                <li><a href="<?= ADMIN_URL ?>/cast_roles" class="nav-link">Cast Roles</a></li>
                <li><a href="<?= ADMIN_URL ?>/cast" class="nav-link">Cast People</a></li>
                <li><a href="<?= ADMIN_URL ?>/cast_content" class="nav-link">Movie Cast</a></li>
            </ul>
        </li>

    </ul>

</div>

<div id="overlay"></div>
