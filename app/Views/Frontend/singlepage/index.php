 <!-- Single Movie Viewer Section -->
        <div class="smv-hero mb-3">
            <div class="smv-bg" style="background-image: url('<?php echo BASE_URL; ?>/assets/images/single/single2.webp');"></div>
            <video class="smv-video" muted preload="none">
                <source src="<?php echo BASE_URL; ?>/assets/videos/Super30.mp4" type="video/mp4">
            </video>
            <div class="smv-overlay"></div>
            <div class="container smv-content text-light">
                <h1 class="fw-bold display-4">Super 30</h1>
                <p class="smv-meta small text-white-50 mb-1">
                    U | Biopic | Hindi | 2019
                </p>
                <p class="smv-desc w-50 fs-6">
                    Based on the life of ace mathematician Anand Kumar, who trained 30 underprivileged students to crack one of the toughest entrance exams in India - IIT.
                </p>
                <p class="smv-audio small text-white-50">Audio Available in: Hindi</p>
                <div class="smv-actions d-flex gap-3 mt-3">
                    <a href="<?php echo BASE_URL; ?>/assets/videos/record.mp4" class="btn btn-light px-4 py-2">
                        <i class="bi bi-play me-2"></i> Watch Now
                    </a>

                    <button class="btn btn-outline-light px-4 py-2">
                        <i class="bi bi-plus-lg me-2"></i> Add To Watchlist
                    </button>                                                                                               
                </div>
            </div>
            <div class="smv-share">
                <i class="bi bi-share-fill"></i>
            </div>
        </div>

<?php require ROOT_PATH . "app/Views/Frontend/home/wifi_banner.php"; ?>

<div class="smv-tabs-container mt-4">
            <!-- Tabs -->
            <div class="smv-tabs">
                <button class="smv-tab active" data-target="#similar">More like this</button>
                <button class="smv-tab" data-target="#cast">Cast & more</button>
            </div>

            <!-- Underline -->
            <div class="smv-tab-underline mb-4"></div>

            <!-- Tab Content Wrapper -->
            <div class="smv-content-area">

                <!-- Similar Movies -->
                <div id="similar" class="smv-tab-content active">
                    <h3 class="text-white mb-3">If You Liked This, Try These</h3>

                    <div class="movie-scroll-container">
                        <button class="scroll-btn left-btn">❮</button>
                        <div class="movie-scroller">
                            <div class="movie-scroll-inner">
                                <div class="movie-card-wrapper">
                                    <a href="./singlepage.html" class="movie-link">
                                        <div class="movie-card">
                                            <img src="<?php echo BASE_URL; ?>/assets/images/index/insidiousthelastkey_portrait_thumb.webp" alt="movie">
                                            <div class="card-overlay">
                                                <h5 class="movie-title">Insidious The Lastkey</h5>
                                                <div class="badges">
                                                    <span class="badge age">U/A 13+</span>
                                                    <span class="badge type">Movie</span>
                                                </div>
                                                <button class="watchlist-btn"><span>+</span> Add To Watchlist</button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="movie-card-wrapper">
                                    <a href="./singlepage.html" class="movie-link">
                                        <div class="movie-card">
                                            <img src="<?php echo BASE_URL; ?>/assets/images/index/super30.webp" alt="movie">
                                            <div class="card-overlay">
                                                <h5 class="movie-title">Super 30</h5>
                                                <div class="badges">
                                                    <span class="badge age">U/A 13+</span>
                                                    <span class="badge type">Movie</span>
                                                </div>
                                                <button class="watchlist-btn"><span>+</span> Add To Watchlist</button>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="movie-card-wrapper">
                                    <a href="./singlepage.html" class="movie-link">
                                        <div class="movie-card">
                                            <img src="<?php echo BASE_URL; ?>/assets/images/index/lokah.webp" alt="movie">
                                            <div class="card-overlay">
                                                <h5 class="movie-title">Lokah</h5>
                                                <div class="badges">
                                                    <span class="badge age">U/A 13+</span>
                                                    <span class="badge type">Movie</span>
                                                </div>
                                                <button class="watchlist-btn"><span>+</span> Add To Watchlist</button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="movie-card-wrapper">
                                    <a href="./singlepage.html" class="movie-link">
                                        <div class="movie-card">
                                            <img src="<?php echo BASE_URL; ?>/assets/images/index/insidiousthelastkey_portrait_thumb.webp" alt="movie">
                                            <div class="card-overlay">
                                                <h5 class="movie-title">Insidious The Lastkey</h5>
                                                <div class="badges">
                                                    <span class="badge age">U/A 13+</span>
                                                    <span class="badge type">Movie</span>
                                                </div>
                                                <button class="watchlist-btn"><span>+</span> Add To Watchlist</button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="movie-card-wrapper">
                                    <a href="./singlepage.html" class="movie-link">
                                        <div class="movie-card">
                                            <img src="<?php echo BASE_URL; ?>/assets/images/index/super30.webp" alt="movie">
                                            <div class="card-overlay">
                                                <h5 class="movie-title">Super 30</h5>
                                                <div class="badges">
                                                    <span class="badge age">U/A 13+</span>
                                                    <span class="badge type">Movie</span>
                                                </div>
                                                <button class="watchlist-btn"><span>+</span> Add To Watchlist</button>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="movie-card-wrapper">
                                    <a href="./singlepage.html" class="movie-link">
                                        <div class="movie-card">
                                            <img src="<?php echo BASE_URL; ?>/assets/images/index/lokah.webp" alt="movie">
                                            <div class="card-overlay">
                                                <h5 class="movie-title">Lokah</h5>
                                                <div class="badges">
                                                    <span class="badge age">U/A 13+</span>
                                                    <span class="badge type">Movie</span>
                                                </div>
                                                <button class="watchlist-btn"><span>+</span> Add To Watchlist</button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="movie-card-wrapper">
                                    <a href="./singlepage.html" class="movie-link">
                                        <div class="movie-card">
                                            <img src="<?php echo BASE_URL; ?>/assets/images/index/lokah.webp" alt="movie">
                                            <div class="card-overlay">
                                                <h5 class="movie-title">Lokah</h5>
                                                <div class="badges">
                                                    <span class="badge age">U/A 13+</span>
                                                    <span class="badge type">Movie</span>
                                                </div>
                                                <button class="watchlist-btn"><span>+</span> Add To Watchlist</button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="movie-card-wrapper">
                                    <a href="./singlepage.html" class="movie-link">
                                        <div class="movie-card">
                                            <img src="<?php echo BASE_URL; ?>/assets/images/index/insidiousthelastkey_portrait_thumb.webp" alt="movie">
                                            <div class="card-overlay">
                                                <h5 class="movie-title">Insidious The Lastkey</h5>
                                                <div class="badges">
                                                    <span class="badge age">U/A 13+</span>
                                                    <span class="badge type">Movie</span>
                                                </div>
                                                <button class="watchlist-btn"><span>+</span> Add To Watchlist</button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="movie-card-wrapper">
                                    <a href="./singlepage.html" class="movie-link">
                                        <div class="movie-card">
                                            <img src="<?php echo BASE_URL; ?>/assets/images/index/super30.webp" alt="movie">
                                            <div class="card-overlay">
                                                <h5 class="movie-title">Super 30</h5>
                                                <div class="badges">
                                                    <span class="badge age">U/A 13+</span>
                                                    <span class="badge type">Movie</span>
                                                </div>
                                                <button class="watchlist-btn"><span>+</span> Add To Watchlist</button>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="movie-card-wrapper">
                                    <a href="./singlepage.html" class="movie-link">
                                        <div class="movie-card">
                                            <img src="<?php echo BASE_URL; ?>/assets/images/index/lokah.webp" alt="movie">
                                            <div class="card-overlay">
                                                <h5 class="movie-title">Lokah</h5>
                                                <div class="badges">
                                                    <span class="badge age">U/A 13+</span>
                                                    <span class="badge type">Movie</span>
                                                </div>
                                                <button class="watchlist-btn"><span>+</span> Add To Watchlist</button>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <button class="scroll-btn right-btn">❯</button>
                    </div>
                </div>

                <!-- Cast & More -->
                <div id="cast" class="smv-tab-content">

                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="text-white m-0">Starring</h3>
                    </div>
                    <div class="cast-section">
                        <div class="cast-scroll-container">
                            <div class="cast-scroller">
                                <div class="cast-scroll-inner">

                                    <div class="cast-card-wrapper">
                                        <a href="./singlecast.html" class="cast-link">
                                            <div class="cast-card">
                                                <img src="<?php echo BASE_URL; ?>/assets/images/single/cam1.webp" alt="cast">
                                                <div class="cast-overlay">
                                                    <h5 class="cast-title">Allu Arjun</h5>
                                                    <div class="cast-badges">
                                                        <span class="cast-badge role">Actor</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="cast-card-wrapper">
                                        <a href="./singlecast.html" class="cast-link">
                                            <div class="cast-card">
                                                <img src="<?php echo BASE_URL; ?>/assets/images/single/cam2.webp" alt="cast">
                                                <div class="cast-overlay">
                                                    <h5 class="cast-title">Rashmika</h5>
                                                    <div class="cast-badges">
                                                        <span class="cast-badge role">Actor</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="cast-card-wrapper">
                                        <a href="./singlecast.html" class="cast-link">
                                            <div class="cast-card">
                                                <img src="<?php echo BASE_URL; ?>/assets/images/single/cam3.webp" alt="cast">
                                                <div class="cast-overlay">
                                                    <h5 class="cast-title">Sukumar</h5>
                                                    <div class="cast-badges">
                                                        <span class="cast-badge role">Director</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="cast-card-wrapper">
                                        <a href="./singlecast.html" class="cast-link">
                                            <div class="cast-card">
                                                <img src="<?php echo BASE_URL; ?>/assets/images/single/cam4.webp" alt="cast">
                                                <div class="cast-overlay">
                                                    <h5 class="cast-title">Shriya Saran</h5>
                                                    <div class="cast-badges">
                                                        <span class="cast-badge role">Actor</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <h3 class="text-white mb-4">About Super 30</h3>

                    <div class="row text-white">
                        <div class="col-md-6 mb-4">
                            <h5 class="mb-1">Genre</h5>
                            <p class="text">Biopic</p>
                        </div>

                        <div class="col-md-6 mb-4">
                            <h5 class="mb-1">Audio & Subtitles</h5>
                            <p class="text">Audio: Hindi</p>
                        </div>

                        <div class="col-md-6 mb-4">
                            <h5 class="mb-1">Release Year</h5>
                            <p class="text">2019</p>
                        </div>
                    </div>

                    <hr class="border-secondary">

                    <div class="mt-4">
                        <h5>Description</h5>
                        <p class="text">
                            Based on the life of ace mathematician Anand Kumar, who trained 30 underprivileged students 
                            to crack one of the toughest entrance exams in India IIT.
                        </p>
                    </div>

                </div>
            </div>
        </div>
<script>
    const tabs = document.querySelectorAll('.smv-tab');
    const contents = document.querySelectorAll('.smv-tab-content');

    tabs.forEach(tab => {
    tab.onclick = () => {
        tabs.forEach(t => t.classList.remove('active'));
        contents.forEach(c => c.classList.remove('active'));

        tab.classList.add('active');
        document.querySelector(tab.dataset.target).classList.add('active');
    };
    });
        const scrollers = document.querySelectorAll(".movie-scroll-container");

    scrollers.forEach(container => {
        const scroller = container.querySelector(".movie-scroller");
        const leftBtn = container.querySelector(".left-btn");
        const rightBtn = container.querySelector(".right-btn");

        const scrollAmount = 300; 

        leftBtn.addEventListener("click", () => {
            scroller.scrollBy({
                left: -scrollAmount,
                behavior: "smooth"
            });
        });

        rightBtn.addEventListener("click", () => {
            scroller.scrollBy({
                left: scrollAmount,
                behavior: "smooth"
            });
        });
    });

    const hero = document.querySelector('.smv-hero');
    const video = document.querySelector('.smv-video');
    const bg = document.querySelector('.smv-bg');

    hero.addEventListener('mouseenter', () => {
        video.style.opacity = "1";
        bg.style.opacity = "0";
        if (video.currentTime === 0 || video.ended) {
            video.currentTime = 0;
        }
        video.play();
    });

    hero.addEventListener('mouseleave', () => {
    });

    video.addEventListener('ended', () => {
        video.style.opacity = "0";
        bg.style.opacity = "1";
    });

</script>