<div class="container py-4 profile-page">
    <!-- Phone number + edit -->
    <div class="d-flex align-items-center gap-2 mb-4 phone-bar">
        <i class="bi bi-pencil fs-4"></i>
        <span class="phone-number"><?= htmlspecialchars($user['email']) ?></span>
    </div>

    <!-- Options Cards -->
    <div class="row g-4 mb-1 justify-content-center">

        <div class="col-6 col-md-3">
            <a href="<?= BASE_URL ?>/myplan">
                <div class="profile-option-card">
                    <i class="bi bi-percent icon"></i>
                    <p class="title">Plans & Offers</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="<?= BASE_URL ?>/profile/help">
                <div class="profile-option-card">
                    <i class="bi bi-headset icon"></i>
                    <p class="title">Help Center</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="<?= BASE_URL ?>/profile/language">
                <div class="profile-option-card">
                    <i class="bi bi-translate icon"></i>
                    <p class="title">Language</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="<?= BASE_URL ?>/profile/logout">
                <div class="profile-option-card">
                    <i class="bi bi-box-arrow-right icon"></i>
                    <p class="title">Logout</p>
                </div>
            </a>
        </div>

    </div>

</div>

<?php if (!empty($watchlist)): ?>

    <div class="movie-section mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-white m-0">My Watchlist</h3>
        </div>

        <div class="movie-scroll-container">
            <button class="scroll-btn left-btn">❮</button>

            <div class="movie-scroller">
                <div class="movie-scroll-inner">

                    <?php foreach ($watchlist as $movie): ?>
                        <div class="movie-card-wrapper">
                            <a href="<?= BASE_URL ?>/movie/show?id=<?= (int)$movie['id'] ?>" class="movie-link">
                                <div class="movie-card">

                                    <?php if ($movie['is_free']): ?>
                                        <span class="free-badge">Free</span>
                                    <?php endif; ?>

                                    <img src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($movie['poster_url']) ?>"
                                        alt="<?= htmlspecialchars($movie['title']) ?>">

                                    <div class="card-overlay">
                                        <h5 class="movie-title">
                                            <?= htmlspecialchars($movie['title']) ?>
                                        </h5>

                                        <div class="badges">
                                            <span class="badge age">U/A 13+</span>
                                            <span class="badge type"><?= htmlspecialchars($movie['type']) ?></span>
                                        </div>

                                        <button class="remove-watchlist-btn" data-id="<?= $movie['id'] ?>">
                                            <i class="bi bi-x-lg"></i> Remove
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

<?php else: ?>

    <!-- EMPTY WATCHLIST -->
    <div class="watchlist-empty text-center mt-4">
        <div class="watchlist-graphic mb-2">
            <i class="bi bi-tv watchlist-icon"></i>
            <i class="bi bi-plus-circle-fill watchlist-icon plus-icon"></i>
        </div>
        <h4 class="text-light mb-2">Your Watchlist will appear here</h4>
        <p class="text-secondary fs-6">
            Find movies & shows and add them to your Watchlist.
        </p>
    </div>

<?php endif; ?>

<!-- Upper Footer -->
<?php require ROOT_PATH . "app/Views/layouts/upper_footer.php"; ?>

<script>
    document.querySelectorAll('.remove-watchlist-btn').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();

            fetch("<?= BASE_URL ?>/movie/remove-watchlist", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "movie_id=" + btn.dataset.id
            })
            .then(() => {
                btn.closest('.movie-card-wrapper').remove();

                // if empty → reload to show empty state
                if (document.querySelectorAll('.movie-card-wrapper').length === 0) {
                    location.reload();
                }
            });
        });
    });
</script>
