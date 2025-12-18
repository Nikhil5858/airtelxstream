<!-- Hero Slider -->
<?php require ROOT_PATH . "app/Views/Frontend/home/hero_slider.php"; ?>

<!-- OTT Logos Row -->
<?php require ROOT_PATH . "app/Views/Frontend/home/ott_logos.php"; ?>

<?php foreach ($sections as $section): ?>

    <div class="movie-section mt-3">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-white m-0">
                <?= htmlspecialchars($section['title']) ?>
            </h3>

            <a href="#" class="text-white">See All</a>
        </div>

        <div class="movie-scroll-container">
            <button class="scroll-btn left-btn">❮</button>

            <div class="movie-scroller">
                <div class="movie-scroll-inner">

                    <?php foreach ($section['movies'] as $movie): ?>
                        <div class="movie-card-wrapper">
                            <a href="<?= BASE_URL ?>/movie/show/<?= (int)$movie['id'] ?>" class="movie-link">
                                <div class="movie-card">

                                    <?php if ($movie['is_free']): ?>
                                        <span class="free-badge">Free</span>
                                    <?php endif; ?>

                                    <img src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($movie['poster_url']) ?>">

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

                                        <button class="watchlist-btn">
                                            <span>+</span> Add To Watchlist
                                        </button>
                                    </div>

                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <button class="scroll-btn right-btn">❯</button>
        </div>
    </div>

<?php endforeach; ?>


<!-- Upper Footer -->
<?php require ROOT_PATH . "app/Views/layouts/upper_footer.php"; ?>