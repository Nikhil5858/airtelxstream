<div class="myplan-page p-5 ms-5">
    <div class="main-plan-wrapper p-4 mb-5">
        <h3 class="text-light fw-bold mb-1">My Plans</h3>
        <p class="text-secondary small mb-4">
            One Stop For All Your Favourite OTT Subscription
        </p>

        <div class="text-center mb-5">
            <a
                href="https://www.airtel.in/new-connection/broadband/?price=499&utm_source=xstream&utm_campaign=bb_acq_xstream_continue_watch_web"><img
                    src="<?= BASE_URL ?>/assets/images/myplan/wifi-banner.webp"
                    class="img-fluid rounded-2 wifi-banner" /></a>
        </div>

        <h3 class="text-light fw-bold">Choose Your Plan</h3>
            <?php if (empty($plans)): ?>
                <p class="text-light">No plans available</p>
            <?php endif; ?>

            <div class="inner-plan-cards">

            <?php foreach ($plans as $plan): ?>
                <div class="plan-card d-flex justify-content-center mt-2">
                    <div class="plan-card p-4">

                        <span class="badge trending-badge mb-3">TRENDING OFFER</span>

                        <h4 class="text-light fw-bold mb-2">
                            <?= htmlspecialchars($plan['plan_name']) ?>
                            for
                            <span class="new-price">₹<?= (int)$plan['price'] ?></span>
                        </h4>

                        <p class="text-secondary small mb-3">
                            Valid for <?= (int)$plan['duration_days'] ?> days • Auto Renews • Cancel Anytime
                        </p>

                        <!-- YOUR ICONS: UNTOUCHED -->
                        <div class="d-flex gap-3 align-items-center mb-3">
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan1.webp" class="ott-icon" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan2.webp" class="ott-icon" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan3.webp" class="ott-icon" />
                        </div>

                        <h6 class="text-secondary text-uppercase small mb-2">
                            + XSTREAM PLAY (21+ OTTs)
                        </h6>

                        <!-- YOUR GRID: UNTOUCHED -->
                        <div class="ott-grid mb-4">
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan4.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan5.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan6.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan7.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan8.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan9.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan10.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan11.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan12.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan13.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan14.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan15.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan16.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan17.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan18.webp" />
                            <img src="<?= BASE_URL ?>/assets/images/myplan/plan19.webp" />
                        </div>

                        <form method="POST" action="<?= BASE_URL ?>/myplan/subscribe">
                            <input type="hidden" name="subscription_id" value="<?= $plan['id'] ?>">
                            <button class="subscribe-btn w-100 py-2">
                                Subscribe Now for ₹<?= (int)$plan['price'] ?>
                            </button>
                        </form>

                    </div>
                </div>
            <?php endforeach; ?>

            </div>


    </div>
</div>

<!-- Upper Footer -->
<?php require ROOT_PATH . "app/Views/layouts/upper_footer.php"; ?>
