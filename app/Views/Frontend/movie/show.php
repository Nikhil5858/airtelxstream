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
        <?php if ($movie['type'] === 'series'): ?>
            <button class="smv-tab active" data-target="#episodes">Episodes</button>
            <button class="smv-tab" data-target="#cast">Cast & More</button>
        <?php else: ?>
            <button class="smv-tab active" data-target="#about">About</button>
            <button class="smv-tab" data-target="#cast">Cast</button>
        <?php endif; ?>
    </div>

    <div class="smv-tab-underline mb-4"></div>

    <div class="smv-content-area">

        <?php if ($movie['type'] === 'series'): ?>
            <div id="episodes" class="smv-tab-content active">

                <div class="eps-header">
                    <div class="eps-dropdown">
                        <div class="eps-selected">
                            Season 1
                            <i class="bi bi-caret-down-fill"></i>
                        </div>

                        <ul class="eps-list">
                            <?php foreach ($seasons as $s): ?>
                                <li data-season="<?= $s['season_number'] ?>">
                                    Season <?= $s['season_number'] ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="eps-grid mt-4">
                    <?php foreach ($episodes as $e): ?>
                        <div class="eps-card" data-season="<?= $e['season_number'] ?>">
                            <img src="<?= BASE_URL ?>/assets/images/<?= $e['poster_img'] ?>">
                            <div class="eps-info">
                                <h5>
                                    Ep <?= $e['episode_number'] ?>.
                                    <?= htmlspecialchars($e['title']) ?>
                                </h5>
                                <span>—</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        <?php endif; ?>

        <?php if ($movie['type'] === 'movie'): ?>
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
        <?php endif; ?>

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
    /* ================= TABS ================= */
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

    /* ================= HERO VIDEO ================= */
    const hero = document.querySelector('.smv-hero');
    const video = document.querySelector('.smv-video');
    const bg = document.querySelector('.smv-bg');

    if (hero && video && bg) {
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
    }

    /* ================= SERIES ONLY LOGIC ================= */
    const epsDropdown = document.querySelector('.eps-dropdown');
    const epsSelected = document.querySelector('.eps-selected');
    const seasonItems = document.querySelectorAll('.eps-list li');
    const epsCards = document.querySelectorAll('.eps-card');

    if (epsDropdown && epsSelected && seasonItems.length && epsCards.length) {

        function showSeason(season) {
            epsCards.forEach(card => {
                card.style.display =
                    card.dataset.season === season ? 'block' : 'none';
            });
        }

        const firstSeason = seasonItems[0].dataset.season;
        epsSelected.innerHTML =
            'Season ' + firstSeason + ' <i class="bi bi-caret-down-fill"></i>';
        showSeason(firstSeason);

        const epsList = document.querySelector('.eps-list');

        if (epsList) {
            epsList.style.display = 'none';
        }

        epsSelected.addEventListener('click', (e) => {
            e.stopPropagation();
            epsList.style.display =
                epsList.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', () => {
            epsList.style.display = 'none';
        });

        seasonItems.forEach(item => {
            item.addEventListener('click', () => {
                const season = item.dataset.season;

                epsSelected.innerHTML =
                    'Season ' + season + ' <i class="bi bi-caret-down-fill"></i>';

                showSeason(season);
                epsList.style.display = 'none';
            });
        });

    }
</script>