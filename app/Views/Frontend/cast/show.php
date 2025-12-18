<?php
/** @var array $cast */
?>

<div class="person-details-section mt-4">

    <div class="container d-flex align-items-start justify-content-between person-details-wrapper">

        <div class="person-left">

            <a href="javascript:history.back()" class="back-btn">
                <i class="bi bi-arrow-left text-white"></i>
            </a>

            <h1 class="person-name">
                <?= htmlspecialchars($cast['name']) ?>
            </h1>

            <p class="person-dob">
                Born: <?= date('F d, Y', strtotime($cast['date_of_birth'])) ?>
            </p>

            <p class="person-bio">
                <?= nl2br(htmlspecialchars($cast['bio'])) ?>
            </p>

        </div>

        <div class="person-right">
            <img src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($cast['profile_image_url']) ?>"
                 class="person-photo"
                 alt="<?= htmlspecialchars($cast['name']) ?>">
        </div>

    </div>

</div>
