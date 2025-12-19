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

    <?php if ($section['type'] === 'top10'): ?>
        <?php require ROOT_PATH . "app/Views/Frontend/home/top10.php"; ?>
    <?php else: ?>
        <?php require ROOT_PATH . "app/Views/Frontend/home/section_slider.php"; ?>
    <?php endif; ?>

<?php endforeach; ?>

<?php require ROOT_PATH . "app/Views/Frontend/home/language.php"; ?>

<!-- Top 10 -->

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