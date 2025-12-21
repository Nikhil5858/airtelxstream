<div class="category-wrapper py-3 mt-2">
    <div class="container">
        <div class="category-buttons">

            <?php
            $visibleLimit = 8;
            $visibleGenres = array_slice($genres, 0, $visibleLimit);
            $moreGenres = array_slice($genres, $visibleLimit);
            ?>

            <!-- VISIBLE GENRES -->
            <?php foreach ($visibleGenres as $g): ?>
                <a href="<?= BASE_URL ?>/genre/show?id=<?= (int)$g['id'] ?>"
                   class="category-btn">
                    <?= htmlspecialchars($g['name']) ?>
                </a>
            <?php endforeach; ?>

            <!-- SEE MORE DROPDOWN -->
            <?php if (!empty($moreGenres)): ?>
                <div class="dropdown">
                    <button class="category-btn dropdown-toggle"
                            data-bs-toggle="dropdown">
                        See More
                    </button>

                    <ul class="dropdown-menu dropdown-menu-dark">
                        <?php foreach ($moreGenres as $g): ?>
                            <li>
                                <a href="<?= BASE_URL ?>/genre/show?id=<?= (int)$g['id'] ?>"
                                   class="dropdown-item">
                                    <?= htmlspecialchars($g['name']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
                            