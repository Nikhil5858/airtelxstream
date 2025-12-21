<!-- OTT Logos Row -->
<div class="live-section">
    <div class="live-scroll-container">
        <button class="scroll-btn left-btn">❮</button>

        <div class="live-scroller">
            <div class="live-scroll-inner">

                <?php foreach ($otts as $ott): ?>
                    <div class="live-card-wrapper">
                        <a href="<?= BASE_URL ?>/ott/show?id=<?= (int)$ott['id'] ?>">
                            <div class="live-card">
                                <img
                                    src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($ott['logo_url']) ?>"
                                    alt="<?= htmlspecialchars($ott['name']) ?>">
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <button class="scroll-btn right-btn">❯</button>
    </div>
</div>
<!-- OTT Logos Row -->
