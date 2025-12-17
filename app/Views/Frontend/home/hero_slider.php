
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
    <div class="carousel-inner">

        <?php foreach ($banners as $index => $movie): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">

                <img src="<?= BASE_URL . '/assets/images/' . htmlspecialchars($movie['banner_url']) ?>"
                     class="d-block w-100 hero-slide-img">


                <div class="hero-overlay"></div>

                <div class="hero-content">
                    <div class="hero-left">
                        <h2 class="hero-title">
                            <?= htmlspecialchars($movie['title']) ?>
                        </h2>

                        <div class="hero-tags">
                            <?php if (!empty($movie['language'])): ?>
                                <span class="hero-tag"><?= htmlspecialchars($movie['language']) ?></span>
                                <span class="hero-dot">•</span>
                            <?php endif; ?>

                            <?php if (!empty($movie['genre'])): ?>
                                <span class="hero-tag"><?= htmlspecialchars($movie['genre']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="hero-right">
                        <button class="hero-watchlist-btn">+ Add to Watchlist</button>

                        <?php if (!empty($movie['movie_url'])): ?>
                            <a href="<?= BASE_URL . '/assets/videos/' . htmlspecialchars($movie['movie_url']) ?>">
                                <button class="hero-watchnow-btn">▶ Watch Now</button>
                            </a>

                        <?php endif; ?>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>

    </div>

    <button class="hero-arrow hero-prev" type="button"
            data-bs-target="#heroCarousel" data-bs-slide="prev">
        <i>&lt;</i>
    </button>

    <button class="hero-arrow hero-next" type="button"
            data-bs-target="#heroCarousel" data-bs-slide="next">
        <i>&gt;</i>
    </button>
</div>
