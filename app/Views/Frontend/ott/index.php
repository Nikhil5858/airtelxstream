<!-- OTT Logos Row -->
<div class="ott-section">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="ott-title m-0">Explore OTTs</h3>
        <a href="./seeallotts.html" class="text-white">See All</a>
    </div>
    <div class="ott-scroll-container">

        <button class="ott-scroll-btn ott-left-btn">❮</button>

        <div class="ott-scroller">

            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-jio">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan2.webp">
                    </div>
                </div>
            </a>

            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-zee">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan3.webp">
                    </div>
                </div>
            </a>

            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-sony">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan4.webp">
                    </div>
                </div>
            </a>

            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-aha">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan5.webp">
                    </div>
                </div>
            </a>

            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-lionsgate">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan12.webp">
                    </div>
                </div>
            </a>

            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-hungama">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan14.webp">
                    </div>
                </div>
            </a>
            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-sunnxt">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan15.webp">
                    </div>
                </div>
            </a>

            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-jio">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan2.webp">
                    </div>
                </div>
            </a>

            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-zee">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan3.webp">
                    </div>
                </div>
            </a>

            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-sony">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan4.webp">
                    </div>
                </div>
            </a>

            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-aha">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan5.webp">
                    </div>
                </div>
            </a>

            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-lionsgate">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan12.webp">
                    </div>
                </div>
            </a>

            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-hungama">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan14.webp">
                    </div>
                </div>
            </a>
            <a href="./singleott.html">
                <div class="ott-card-wrapper">
                    <div class="ott-card bg-sunnxt">
                        <img src="<?= BASE_URL ?>/assets/images/ott/plan15.webp">
                    </div>
                </div>
            </a>

        </div>


        <button class="ott-scroll-btn ott-right-btn">❯</button>

    </div>
</div>

<?php foreach ($otts as $ott): ?>

    <!-- OTT BLOCK -->
    <div class="ott-block mb-5 mt-4">

        <!-- OTT HEADER -->
        <div class="d-flex align-items-center mb-4 ms-3">
            <img
                src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($ott['logo_url']) ?>"
                class="section-icon"
                alt="<?= htmlspecialchars($ott['name']) ?>">
            <h3 class="text-white ms-3 mb-0">
                <?= htmlspecialchars($ott['name']) ?>
            </h3>
        </div>

        <div class="movie-section mt-3">
            <div class="movie-scroll-inner">
                <?php foreach ($ott['movies'] as $movie): ?>
                    <div class="movie-card-wrapper">
                        <a href="<?= BASE_URL ?>/movie/show?id=<?= (int)$movie['id'] ?>" class="movie-link">
                            <div class="movie-card">

                                <img
                                    src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($movie['poster_url'] ?? 'default-poster.webp') ?>"
                                    alt="<?= htmlspecialchars($movie['title']) ?>">

                                <div class="card-overlay">
                                    <h5 class="movie-title">
                                        <?= htmlspecialchars($movie['title']) ?>
                                    </h5>

                                    <div class="badges">
                                        <span class="badge age">U/A 13+</span>
                                        <span class="badge type">
                                            <?= htmlspecialchars($movie['type']) ?>
                                        </span>
                                    </div>

                                    <button class="watchlist-btn" type="button">
                                        <span>+</span> Add To Watchlist
                                    </button>
                                </div>

                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

    <?php endforeach; ?>

    </div>
    <!-- Upper Footer -->
    <?php require ROOT_PATH . "app/Views/layouts/upper_footer.php"; ?>