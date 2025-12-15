<div class="main-content">
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-start mt-1">
            <div>
                <h3>Movies</h3>
                <p class="text-muted">Manage movies and OTT content</p>
            </div>

            <button class="btn btn-primary mt-2"
                data-bs-toggle="modal"
                data-bs-target="#addMovieModal">
                <i class="bi bi-plus-lg me-2"></i> Add Movie
            </button>
        </div>

        <!-- MOVIES TABLE -->
        <div class="card mt-3">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Poster</th>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Language</th>
                        <th>Type</th>
                        <th>OTT</th>
                        <th>Genre</th>
                        <th>Free</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                <?php if (!empty($movies)): ?>
                    <?php foreach ($movies as $m): ?>
                        <tr>
                            <td>
                                <?php if ($m['poster_url']): ?>
                                    <img src="<?= $m['poster_url'] ?>" width="45" class="rounded">
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>

                            <td>
                                <strong><?= htmlspecialchars($m['title']) ?></strong>
                            </td>

                            <td><?= $m['release_year'] ?></td>
                            <td><?= htmlspecialchars($m['language']) ?></td>
                            <td><?= ucfirst($m['type']) ?></td>
                            <td><?= ucfirst($m['ott']) ?></td>
                            <td><?= ucfirst($m['genre']) ?></td>

                            <td>
                                <?= $m['is_free']
                                    ? '<span class="badge bg-success-subtle text-success">Yes</span>'
                                    : 'No' ?>
                            </td>

                            <td>
                                <button class="btn btn-outline-primary btn-sm edit-btn"
                                    data-id="<?= $m['id'] ?>"
                                    data-title="<?= htmlspecialchars($m['title']) ?>"
                                    data-year="<?= $m['release_year'] ?>"
                                    data-language="<?= htmlspecialchars($m['language']) ?>"
                                    data-type="<?= $m['type'] ?>"
                                    data-poster="<?= $m['poster_url'] ?>"
                                    data-banner="<?= $m['banner_url'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <form method="post"
                                      action="<?= BASE_URL ?>/admin/movies/delete"
                                      class="d-inline">
                                    <input type="hidden" name="id" value="<?= $m['id'] ?>">
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            No movies found
                        </td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- ================= ADD MOVIE MODAL ================= -->
<div class="modal fade" id="addMovieModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="POST"
                  action="<?= BASE_URL ?>/admin/movies/store"
                  enctype="multipart/form-data">

                <div class="modal-header">
                    <h5 class="modal-title">Add Movie</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Release Year</label>
                        <input type="number" name="release_year" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Language</label>
                        <input type="text" name="language" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select">
                            <option value="movie">Movie</option>
                            <option value="series">Series</option>
                        </select>
                    </div>

                    <!-- FILE INPUTS -->
                    <div class="col-md-6">
                        <label class="form-label">Movie File</label>
                        <input type="file" name="movie_file" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Trailer File</label>
                        <input type="file" name="trailer_file" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="banner_file" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Poster Image</label>
                        <input type="file" name="poster_file" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="is_free" value="1">
                            <label class="form-check-label">Free</label>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save Movie</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- ================= EDIT MOVIE MODAL ================= -->
<div class="modal fade" id="editMovieModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="POST"
                  action="<?= BASE_URL ?>/admin/movies/update"
                  enctype="multipart/form-data">

                <input type="hidden" name="id" id="editId">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Movie</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" id="editTitle" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Release Year</label>
                        <input type="number" name="release_year" id="editYear" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Current Poster</label><br>
                        <img id="editPosterPreview" width="80" class="rounded mb-2">
                        <input type="file" name="poster_file" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Current Banner</label><br>
                        <img id="editBannerPreview" width="120" class="rounded mb-2">
                        <input type="file" name="banner_file" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Replace Movie File</label>
                        <input type="file" name="movie_file" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Replace Trailer File</label>
                        <input type="file" name="trailer_file" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Update Movie</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {

            document.getElementById('editId').value = btn.dataset.id;
            document.getElementById('editTitle').value = btn.dataset.title;
            document.getElementById('editYear').value = btn.dataset.year;

            document.getElementById('editPosterPreview').src = btn.dataset.poster;
            document.getElementById('editBannerPreview').src = btn.dataset.banner;

            new bootstrap.Modal(
                document.getElementById('editMovieModal')
            ).show();
        });
    });
</script>
