<!-- Hero Slider -->
<?php require ROOT_PATH . "app/Views/Frontend/home/hero_slider.php"; ?>

<!-- Category Bar -->
<?php require ROOT_PATH . "app/Views/Frontend/home/categories.php"; ?>

<!-- OTT Logos Row -->
<?php require ROOT_PATH . "app/Views/Frontend/home/ott_logos.php"; ?>

<!-- WiFi Banner -->
<?php require ROOT_PATH . "app/Views/Frontend/home/wifi_banner.php"; ?>

<!-- New Releases -->
<?php require ROOT_PATH . "app/Views/Frontend/home/new_releases.php"; ?>


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
                            <a href="<?= BASE_URL ?>/movie/show?id=<?= (int)$movie['id'] ?>" class="movie-link">
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

                                        <?php if (!empty($movie['in_watchlist'])): ?>
                                            <button class="watchlist-btn added" disabled>
                                                ✓ Added
                                            </button>
                                        <?php else: ?>
                                            <button class="watchlist-btn"
                                                data-movie-id="<?= (int)$movie['id'] ?>">
                                                <span>+</span> Add To Watchlist
                                            </button>
                                        <?php endif; ?>

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


<?php require ROOT_PATH . "app/Views/Frontend/home/language.php"; ?>

<!-- Top 10 -->
<?php require ROOT_PATH . "app/Views/Frontend/home/top10.php"; ?>

<!-- Live News -->
<?php require ROOT_PATH . "app/Views/Frontend/home/live_news.php"; ?>

<!-- Banner -->
<div class="text-center mx-3 mt-3 mb-3">
    <a href="#"><img src="<?= BASE_URL ?>/assets/images/index/banner.png" class="img-fluid rounded-2 wifi-banner"></a>
</div>

<!-- Upper Footer -->
<?php require ROOT_PATH . "app/Views/layouts/upper_footer.php"; ?>

<script>
    document.querySelectorAll('.watchlist-btn:not(.added)').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();

            fetch("<?= BASE_URL ?>/movie/add-watchlist", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "movie_id=" + btn.dataset.movieId
                })
                .then(() => {
                    btn.classList.add('added');
                    btn.innerHTML = "✓ Added";
                    btn.disabled = true;
                });
        });
    });
</script>