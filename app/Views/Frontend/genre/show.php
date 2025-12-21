<h2 class="text-white px-4 mt-3">
    <?= htmlspecialchars($genre['name']) ?> Movies
</h2>

<?php foreach ($sections as $section): ?>
    <?php if (empty($section['movies'])) continue; ?>

    <?php
    // Reuse your existing section layout
    require ROOT_PATH . 'app/Views/Frontend/home/section_slider.php';
    ?>
<?php endforeach; ?>