<body class="seeall-page">

<div class="movie-section mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-white m-0">New Releases</h3>
    </div>

    <div class="movie-scroller">

        <?php if (empty($movies)): ?>
            <p class="text-white text-center">No movies found</p>
        <?php endif; ?>

        <?php foreach ($movies as $movie): ?>
            <div class="movie-card-wrapper">
                <a href="<?= BASE_URL ?>/movie/show?id=<?= (int)$movie['id'] ?>" class="movie-link">
                    <div class="movie-card">

                        <?php if (!empty($movie['is_free'])): ?>
                            <span class="free-badge">Free</span>
                        <?php endif; ?>

                        <img src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($movie['poster_url']) ?>">

                        <div class="card-overlay">
                            <h5 class="movie-title"><?= htmlspecialchars($movie['title']) ?></h5>

                            <div class="badges">
                                <span class="badge type"><?= htmlspecialchars($movie['type']) ?></span>
                            </div>

                            <?php if (!empty($movie['in_watchlist'])): ?>
                                <button class="watchlist-btn added" disabled>✓ Added</button>
                            <?php else: ?>
                                <button class="watchlist-btn" data-movie-id="<?= (int)$movie['id'] ?>">
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

</body>
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
                }).then(() => {
                    btn.classList.add('added');
                    btn.innerHTML = "✓ Added";
                    btn.disabled = true;
                });
            });
        });
    </script>

</body>
<?php require ROOT_PATH . "app/Views/layouts/upper_footer.php"; ?>
