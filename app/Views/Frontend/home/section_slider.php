<?php if (empty($section['movies'])) return; ?>

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

                                <?php if (!empty($movie['is_free'])): ?>
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