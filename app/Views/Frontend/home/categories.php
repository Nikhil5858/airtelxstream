<div class="category-wrapper py-3 mt-2">
    <div class="container">
        <div class="category-buttons">

            <?php
            $visibleLimit = 8;
            $visibleGenres = array_slice($genres, 0, $visibleLimit);
            $moreGenres = array_slice($genres, $visibleLimit);
            ?>

            <?php foreach ($visibleGenres as $g): ?>
                <button class="category-btn"
                        data-genre-id="<?= $g['id'] ?>">
                    <?= htmlspecialchars($g['name']) ?>
                </button>
            <?php endforeach; ?>

            <?php if (!empty($moreGenres)): ?>
                <div class="dropdown">
                    <button class="category-btn dropdown-toggle"
                            data-bs-toggle="dropdown">
                        See More
                    </button>

                    <ul class="dropdown-menu dropdown-menu-dark">
                        <?php foreach ($moreGenres as $g): ?>
                            <li>
                                <a class="dropdown-item"
                                   href="#"
                                   data-genre-id="<?= $g['id'] ?>">
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
