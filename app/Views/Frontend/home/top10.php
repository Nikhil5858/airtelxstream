<?php
if (
    $section['type'] !== 'top10' ||
    empty($section['movies'])
) return;
?>
<div class="top10-section mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-white m-0">
            <?= htmlspecialchars($section['title']) ?>
        </h3>
    </div>

    <div class="top10-scroll-container">
        <div class="top10-scroller">
            <div class="top10-scroll-inner">

                <?php foreach ($section['movies'] as $index => $movie): ?>
                    <div class="top10-card-wrapper ms-4">
                        <a href="<?= BASE_URL ?>/movie/show?id=<?= (int)$movie['id'] ?>" class="movie-link">
                            <div class="top10-number">
                                <?= $index + 1 ?>
                            </div>

                            <div class="top10-card ms-3">
                                <img
                                    src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($movie['poster_url']) ?>"
                                    alt="<?= htmlspecialchars($movie['title']) ?>">

                                <div class="top10-overlay">
                                    <h5 class="top10-title">
                                        <?= htmlspecialchars($movie['title']) ?>
                                    </h5>

                                    <div class="top10-badges">
                                        <span class="top10-badge age">U/A 13+</span>
                                        <span class="top10-badge type">
                                            <?= ucfirst($movie['type']) ?>
                                        </span>
                                    </div>

                                    <?php if (!empty($movie['in_watchlist'])): ?>
                                        <button class="watchlist-btn added" disabled>
                                            ✓ Added
                                        </button>
                                    <?php else: ?>
                                        <button
                                            class="watchlist-btn"
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