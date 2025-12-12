<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirtelXstream</title>

    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets-admin/image/xsteamplay.png">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<div class="page-bg">

    <!-- SIDEBAR -->
    <?php require ROOT_PATH . "app/Views/layouts/sidebar.php"; ?>

    <div class="sidebar-fade"></div>

    <div class="main-content">

        <!-- LOGIN & OTP MODALS -->
        <?php require ROOT_PATH . "app/Views/layouts/modals.php"; ?>
