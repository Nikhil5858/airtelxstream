<?php /** @var array $seasons */ ?>

<div class="main-content">
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-start mt-1">
            <div>
                <h3>Seasons</h3>
                <p class="text-muted">Manage seasons</p>
            </div>

            <button class="btn btn-primary d-flex align-items-center mt-2"
                    data-bs-toggle="modal"
                    data-bs-target="#addSeasonModal">
                <i class="bi bi-plus-lg me-2"></i> Add Season
            </button>
        </div>

        <!-- SEARCH -->
        <div class="card p-3 mt-3">
            <div class="search-input-container">
                <i class="bi bi-search search-icon"></i>
                <input type="text"
                       id="seasonSearch"
                       class="form-control search-input"
                       placeholder="Search seasons...">
            </div>
        </div>

        <!-- TABLE -->
        <div class="card mt-3">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Season Name</th>
                        <th>Season No</th>
                        <th>Episodes</th>
                        <th>Release Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="seasonTable">
                <?php foreach ($seasons as $s): ?>
                    <tr>
                        <td><?= $s['id'] ?></td>
                        <td><strong>Season <?= $s['season_number'] ?></strong></td>
                        <td><?= $s['season_number'] ?></td>
                        <td><?= $s['total_episodes'] ?></td>
                        <td><?= $s['release_year'] ?></td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm edit-btn"
                                    data-id="<?= $s['id'] ?>"
                                    data-season="<?= $s['season_number'] ?>"
                                    data-episodes="<?= $s['total_episodes'] ?>"
                                    data-year="<?= $s['release_year'] ?>">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button class="btn btn-outline-danger btn-sm delete-btn"
                                    data-id="<?= $s['id'] ?>"
                                    data-name="Season <?= $s['season_number'] ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- ADD MODAL -->
        <div class="modal fade" id="addSeasonModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Add Season</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST" action="<?= BASE_URL ?>/admin/seasons/store">
                        <div class="modal-body">

                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label">Season Number</label>
                                <span class="error-message text-danger small d-none"></span>
                            </div>
                            <input type="number"
                                   name="season_number"
                                   class="form-control mb-3"
                                   data-required="true"
                                   data-error="Season number is required">

                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label">Episodes</label>
                                <span class="error-message text-danger small d-none"></span>
                            </div>
                            <input type="number"
                                   name="total_episodes"
                                   class="form-control mb-3"
                                   data-required="true"
                                   data-error="Episodes count is required">

                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label">Release Year</label>
                                <span class="error-message text-danger small d-none"></span>
                            </div>
                            <input type="number"
                                   name="release_year"
                                   class="form-control"
                                   data-required="true"
                                   data-error="Release year is required">

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary">Add Season</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- EDIT MODAL -->
        <div class="modal fade" id="editSeasonModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Season</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST" action="<?= BASE_URL ?>/admin/seasons/update">
                        <div class="modal-body">

                            <input type="hidden" name="id" id="editSeasonId">

                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label">Season Number</label>
                                <span class="error-message text-danger small d-none"></span>
                            </div>
                            <input type="number"
                                   name="season_number"
                                   id="editSeasonNumber"
                                   class="form-control mb-3"
                                   data-required="true"
                                   data-error="Season number is required">

                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label">Episodes</label>
                                <span class="error-message text-danger small d-none"></span>
                            </div>
                            <input type="number"
                                   name="total_episodes"
                                   id="editEpisodes"
                                   class="form-control mb-3"
                                   data-required="true"
                                   data-error="Episodes count is required">

                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label">Release Year</label>
                                <span class="error-message text-danger small d-none"></span>
                            </div>
                            <input type="number"
                                   name="release_year"
                                   id="editReleaseYear"
                                   class="form-control"
                                   data-required="true"
                                   data-error="Release year is required">

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- DELETE MODAL -->
        <div class="modal fade" id="deleteSeasonModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title text-danger">Delete Season</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST" action="<?= BASE_URL ?>/admin/seasons/delete">
                        <div class="modal-body">

                            <input type="hidden" name="id" id="deleteSeasonId">

                            <p>Are you sure you want to delete this season?</p>
                            <p class="fw-bold text-danger mb-0" id="deleteSeasonName"></p>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

<script>
    /* EDIT */
    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            editSeasonId.value = btn.dataset.id;
            editSeasonNumber.value = btn.dataset.season;
            editEpisodes.value = btn.dataset.total_episodes;
            editReleaseYear.value = btn.dataset.year;
            new bootstrap.Modal(editSeasonModal).show();
        });
    });

    /* DELETE */
    document.querySelectorAll(".delete-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            deleteSeasonId.value = btn.dataset.id;
            deleteSeasonName.innerText = btn.dataset.name;
            new bootstrap.Modal(deleteSeasonModal).show();
        });
    });

    /* SEARCH */
    document.getElementById("seasonSearch").addEventListener("keyup", function () {
        const keyword = this.value.toLowerCase().trim();
        document.querySelectorAll("#seasonTable tr").forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(keyword) ? "" : "none";
        });
    });
</script>
