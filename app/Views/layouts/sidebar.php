<div class="sidebar">
    <div class="logo mt-2">
        <img src="<?php echo BASE_URL; ?>/assets/images/xsteamplay.png" class="brand">
    </div>

    <ul class="menu">
        <li><a href="<?php echo BASE_URL; ?>"><i class="bi bi-house"></i><span>Home</span></a></li>
        <li><a href="#"><i class="bi bi-search"></i><span>Search</span></a></li>
        <li><a href="#"><i class="bi bi-layers"></i><span>OTTs</span></a></li>
        <li><a href="#"><i class="bi bi-play-circle"></i><span>Free</span></a></li>
        <li><a href="#"><i class="bi bi-play-btn"></i><span>My Plans</span></a></li>
        <?php if (!empty($_SESSION['user_logged_in'])): ?>

            <li>
                <a href="<?= BASE_URL ?>/profile">
                    <i class="bi bi-person-circle"></i><span>Profile</span>
                </a>
            </li>

        <?php else: ?>
        <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                <i class="bi bi-box-arrow-in-right"></i><span>Log In</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</div>
