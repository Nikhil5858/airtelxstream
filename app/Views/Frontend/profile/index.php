 <div class="container py-4 profile-page">
     <!-- Phone number + edit -->
     <div class="d-flex align-items-center gap-2 mb-4 phone-bar">
         <i class="bi bi-pencil fs-4"></i>
         <span class="phone-number"><?= htmlspecialchars($user['email']) ?></span>
     </div>

     <!-- Options Cards -->
     <div class="row g-4 mb-1 justify-content-center">

         <div class="col-6 col-md-3">
             <a href="<?= BASE_URL ?>/plans">
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

     <!-- Empty Watchlist Block -->
     <div class="watchlist-empty text-center">
         <div class="watchlist-graphic mb-2">
             <i class="bi bi-tv watchlist-icon"></i>
             <i class="bi bi-plus-circle-fill watchlist-icon plus-icon"></i>
         </div>
         <h4 class="text-light mb-2">Your Watchlist will appear here</h4>
         <p class="text-secondary fs-6">
             <span class="text-danger fw-bold">Find</span> movies & shows,
             and click on sidebar to build your Watchlist.
         </p>
     </div>

 </div>
 <!-- Upper Footer -->
<?php require ROOT_PATH . "app/Views/layouts/upper_footer.php"; ?>
