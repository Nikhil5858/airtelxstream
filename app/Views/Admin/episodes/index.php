<?php
/** 
 * @var array
 * @var array
 */
?>

<div class="main-content">
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-start mt-1">
            <div>
                <h3>Episodes</h3>
                <p class="text-muted">Manage season episodes</p>
            </div>

            <button class="btn btn-primary d-flex align-items-center mt-2"
                    data-bs-toggle="modal"
                    data-bs-target="#addEpisodeModal">
                <i class="bi bi-plus-lg me-2"></i> Add Episode
            </button>
        </div>

        <!-- SEARCH -->
        <div class="card p-3 mt-3">
            <div class="search-input-container">
                <i class="bi bi-search search-icon"></i>
                <input type="text"
                       id="episodeSearch"
                       class="form-control search-input"
                       placeholder="Search episodes...">
            </div>
        </div>

        <!-- TABLE -->
        <div class="card mt-3">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Series</th>
                        <th>Season</th>
                        <th>Episode</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="episodeTable">
                <?php foreach ($episodes as $e): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($e['series']) ?></strong></td>
                        <td><?= (int)$e['season_number'] ?></td>
                        <td><?= (int)$e['episode_number'] ?></td>
                        <td><?= htmlspecialchars($e['title']) ?></td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm edit-btn"
                                data-id="<?= $e['id'] ?>"
                                data-episode="<?= $e['episode_number'] ?>"
                                data-title="<?= htmlspecialchars($e['title']) ?>"
                                data-desc="<?= htmlspecialchars($e['description']) ?>"
                                data-url="<?= htmlspecialchars($e['video_url']) ?>">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button class="btn btn-outline-danger btn-sm delete-btn"
                                data-id="<?= $e['id'] ?>"
                                data-title="<?= htmlspecialchars($e['title']) ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>
</div>

<div class="modal fade" id="addEpisodeModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST"
              action="<?= BASE_URL ?>/admin/episodes/store"
              class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Episode</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <label class="form-label">Season</label>
                <select name="season_id"
                        id="seasonSelect"
                        class="form-select mb-3"
                        required>
                    <?php foreach ($seasons as $s): ?>
                        <option value="<?= $s['id'] ?>"
                                data-limit="<?= $s['total_episodes'] ?>"
                                data-used="<?= $s['used_episodes'] ?>">
                            <?= htmlspecialchars($s['movie_title']) ?>
                            - Season <?= $s['season_number'] ?>
                            (<?= $s['used_episodes'] ?>/<?= $s['total_episodes'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label">Episode Number</label>
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <input type="number"
                       name="episode_number"
                       class="form-control mb-3"
                       min="1"
                       data-required="true" data-error="Episode Number is required"
                       >

                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label">Title</label>
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <input type="text"
                       name="title"
                       data-required="true" data-error="Episode Title is required"
                       class="form-control mb-3"
                       >

                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label">Description</label>
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <textarea name="description"
                data-required="true" data-error="Episode Description is required"
                          class="form-control mb-3"></textarea>

                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label">Video URL</label>
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <input type="text"
                       name="video_url"
                       data-required="true" data-error="Episode Video URL is required"
                       class="form-control">

            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <button class="btn btn-primary">Add Episode</button>
            </div>

        </form>
    </div>
</div>

<div class="modal fade" id="editEpisodeModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST"
              action="<?= BASE_URL ?>/admin/episodes/update"
              class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Episode</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" name="id" id="editEpisodeId">

                <label class="form-label">Episode Number</label>
                <input type="number"
                       name="episode_number"
                       id="editEpisodeNumber"
                       class="form-control mb-3"
                       disabled>

                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label">Title</label>
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <input type="text"
                name="title"
                id="editEpisodeTitle"
                data-required="true" data-error="Episode Title is required"
                class="form-control mb-3"
                >
                
                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label">Description</label>
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <textarea name="description"
                id="editEpisodeDesc"
                data-required="true" data-error="Episode Description is required"
                class="form-control mb-3"></textarea>
                
                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label">Video URL</label>
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <input type="text"
                       data-required="true" data-error="Episode Video URL is required"
                       name="video_url"
                       id="editEpisodeUrl"
                       class="form-control">
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <button class="btn btn-primary">Save Changes</button>
            </div>

        </form>
    </div>
</div>

<div class="modal fade" id="deleteEpisodeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST"
              action="<?= BASE_URL ?>/admin/episodes/delete"
              class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger">Delete Episode</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id" id="deleteEpisodeId">
                <p>Are you sure you want to delete this episode?</p>
                <p class="fw-bold text-danger mb-0" id="deleteEpisodeTitle"></p>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <button class="btn btn-danger">Delete</button>
            </div>

        </form>
    </div>
</div>

<div class="modal fade" id="episodeLimitModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger">Episode Limit Reached</h5>
            </div>

            <div class="modal-body">
                <p class="mb-0">
                    You cannot add more episodes to this season.
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById("episodeSearch").addEventListener("keyup", function () {
        const k = this.value.toLowerCase();
        document.querySelectorAll("#episodeTable tr").forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(k) ? "" : "none";
        });
    });

    document.querySelector('form[action$="episodes/store"]').addEventListener('submit', function (e) {
        const sel = document.getElementById('seasonSelect');
        const opt = sel.options[sel.selectedIndex];
        const limit = parseInt(opt.dataset.limit);
        const used  = parseInt(opt.dataset.used);

        if (used >= limit) {
            e.preventDefault();
            new bootstrap.Modal(document.getElementById('episodeLimitModal')).show();
        }
    });

    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            editEpisodeId.value     = btn.dataset.id;
            editEpisodeNumber.value = btn.dataset.episode;
            editEpisodeTitle.value  = btn.dataset.title;
            editEpisodeDesc.value   = btn.dataset.desc;
            editEpisodeUrl.value    = btn.dataset.url;
            new bootstrap.Modal(editEpisodeModal).show();
        });
    });

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            deleteEpisodeId.value = btn.dataset.id;
            deleteEpisodeTitle.innerText = btn.dataset.title;
            new bootstrap.Modal(deleteEpisodeModal).show();
        });
    });
</script>
