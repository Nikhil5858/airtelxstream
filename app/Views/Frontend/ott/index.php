<div class="text-center mx-3 mt-3 mb-3">
    <a href="<?= BASE_URL ?>/myplan"><img src="<?= BASE_URL ?>/assets/images/index/lionsgateselect.webp" class="img-fluid rounded-2 wifi-banner"></a>
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

    <?php endforeach; ?>

    </div>

    <!-- Banner -->
<?php require ROOT_PATH . "app/Views/Frontend/home/wifi_banner.php"; ?>


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