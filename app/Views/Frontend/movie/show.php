<?php
/** @var array $movie */
/** @var array $cast */
?>

<!-- ================= HERO ================= -->
<div class="smv-hero">

    <div class="smv-bg"
         style="background-image: url('<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($movie['banner_url']) ?>')">
    </div>

    <video class="smv-video" muted preload="none">
        <source src="<?= BASE_URL ?>/assets/videos/<?= htmlspecialchars($movie['movie_url']) ?>" type="video/mp4">
    </video>

    <div class="smv-overlay"></div>

    <div class="container smv-content text-light">
        <h1 class="fw-bold display-4"><?= htmlspecialchars($movie['title']) ?></h1>

        <p class="smv-meta small text-white-50 mb-1">
            <?= htmlspecialchars($movie['certificate'] ?? 'U') ?> |
            <?= htmlspecialchars($movie['genre']) ?> |
            <?= htmlspecialchars($movie['language']) ?> |
            <?= (int)$movie['release_year'] ?>
        </p>
        <?php
            $desc = strip_tags($movie['description']);
            $limit = 180;

            if (strlen($desc) > $limit) {
                $desc = substr($desc, 0, $limit) . '...';
            }
        ?>
        <p class="smv-desc w-50 fs-6">
            <?= htmlspecialchars($desc) ?>
        </p>
        <p class="smv-audio small text-white-50">
            Audio Available in: <?= htmlspecialchars($movie['language']) ?>
        </p>

        <div class="smv-actions d-flex gap-3 mt-3">
            <a href="<?= BASE_URL ?>/assets/videos/<?= htmlspecialchars($movie['movie_url']) ?>"
               class="btn btn-light px-4 py-2">
                <i class="bi bi-play me-2"></i> Watch Now
            </a>

            <button class="btn btn-outline-light px-4 py-2">
                <i class="bi bi-plus-lg me-2"></i> Add To Watchlist
            </button>
        </div>
    </div>
</div>

<!-- ================= TABS ================= -->
<div class="smv-tabs-container mt-4">

    <div class="smv-tabs">
        <button class="smv-tab active" data-target="#about">About</button>
        <button class="smv-tab" data-target="#cast">Cast</button>
    </div>

    <div class="smv-tab-underline mb-4"></div>

    <div class="smv-content-area">

        <!-- ABOUT (DEFAULT) -->
        <div id="about" class="smv-tab-content active">
            <h3 class="text-white mb-4">
                About <?= htmlspecialchars($movie['title']) ?>
            </h3>

            <div class="row text-white">
                <div class="col-md-6 mb-3">
                    <strong>Genre</strong>
                    <p><?= htmlspecialchars($movie['genre']) ?></p>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Language</strong>
                    <p><?= htmlspecialchars($movie['language']) ?></p>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Release Year</strong>
                    <p><?= (int)$movie['release_year'] ?></p>
                </div>
            </div>

            <hr class="border-secondary">

            <p><?= nl2br(htmlspecialchars($movie['description'])) ?></p>
        </div>

        <!-- CAST -->
        <div id="cast" class="smv-tab-content">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-white m-0">Starring</h3>
            </div>

            <?php if (!empty($cast)): ?>
                <div class="cast-section">
                    
                    <div class="cast-scroll-container">
                        <div class="cast-scroller">
                            <div class="cast-scroll-inner">

                                <?php foreach ($cast as $c): ?>
                                    <div class="cast-card-wrapper">
                                        <a href="<?= BASE_URL ?>/cast/show?id=<?= (int)$c['id'] ?>" class="cast-link">
                                            <div class="cast-card">
                                                <img src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($c['profile_image_url']) ?>"
                                                    alt="<?= htmlspecialchars($c['name']) ?>">

                                                <div class="cast-overlay">
                                                    <h5 class="cast-title"><?= htmlspecialchars($c['name']) ?></h5>
                                                    <div class="cast-badges">
                                                        <span class="cast-badge role">
                                                            <?= htmlspecialchars($c['role_name']) ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-white-50">No cast information available.</p>
            <?php endif; ?>
        </div>

    </div>
</div>

<!-- ================= FOOTER ================= -->
<?php require ROOT_PATH . "app/Views/layouts/upper_footer.php"; ?>

<!-- ================= JS ================= -->
<script>
    const tabs = document.querySelectorAll('.smv-tab');
    const contents = document.querySelectorAll('.smv-tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));

            tab.classList.add('active');
            document.querySelector(tab.dataset.target).classList.add('active');
        });
    });

    const hero  = document.querySelector('.smv-hero');
    const video = document.querySelector('.smv-video');
    const bg    = document.querySelector('.smv-bg');

    hero.addEventListener('mouseenter', () => {
        video.style.opacity = "1";
        bg.style.opacity = "0";
        video.currentTime = 0;
        video.play();
    });

    video.addEventListener('ended', () => {
        video.style.opacity = "0";
        bg.style.opacity = "1";
    });
</script>
