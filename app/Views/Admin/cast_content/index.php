<?php

/** @var array $items */ ?>

<div class="main-content">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-start mt-1">
            <div>
                <h3>Movie Cast</h3>
                <p class="text-muted">Assign cast & roles to movies</p>
            </div>

            <button class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addCastContentModal">
                <i class="bi bi-plus-lg"></i> Add Cast
            </button>
        </div>

        <div class="card mt-3">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Movie</th>
                        <th>Cast</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($items as $i): ?>
                        <tr>
                            <td><?= htmlspecialchars($i['movie_title']) ?></td>
                            <td><?= htmlspecialchars($i['cast_name']) ?></td>
                            <td><?= htmlspecialchars($i['role_name']) ?></td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm edit-btn"
                                    data-id="<?= $i['id'] ?>"
                                    data-movie="<?= $i['movie_id'] ?>"
                                    data-cast="<?= $i['cast_id'] ?>"
                                    data-role="<?= $i['role_id'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>


                                <button class="btn btn-outline-danger btn-sm delete-btn"
                                    data-id="<?= $i['id'] ?>">
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

<!-- ADD MODAL -->
<div class="modal fade" id="addCastContentModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST"
            action="<?= BASE_URL ?>/admin/cast_content/store"
            class="modal-content">

            <div class="modal-header">
                <h5>Add Movie Cast</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="d-flex justify-content-between align-items-center">
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <select name="movie_id" class="form-select mb-3" data-required="true" data-error="Select Movie is required">
                    <option value="">Select Movie</option>
                    <?php foreach ($movies as $m): ?>
                        <option value="<?= $m['id'] ?>"><?= $m['title'] ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <select name="cast_id" class="form-select mb-3" data-required="true" data-error="Select Cast is required">
                    <option value="">Select Cast</option>
                    <?php foreach ($casts as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <select name="cast_roles_id" class="form-select" data-required="true" data-error="Select Role is required">
                    <option value="">Select Role</option>
                    <?php foreach ($roles as $r): ?>
                        <option value="<?= $r['id'] ?>"><?= $r['role_name'] ?></option>
                    <?php endforeach; ?>
                </select>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>
</div>


<!-- EDIT MODAL -->
<div class="modal fade" id="editCastContentModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST"
            action="<?= BASE_URL ?>/admin/cast_content/update"
            class="modal-content">

            <div class="modal-header">
                <h5>Edit Movie Cast</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" name="id" id="editId">

                <select name="movie_id" id="editMovie" class="form-select mb-3" required>
                    <?php foreach ($movies as $m): ?>
                        <option value="<?= $m['id'] ?>"><?= $m['title'] ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="cast_id" id="editCast" class="form-select mb-3" required>
                    <?php foreach ($casts as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="cast_roles_id" id="editRole" class="form-select" required>
                    <?php foreach ($roles as $r): ?>
                        <option value="<?= $r['id'] ?>"><?= $r['role_name'] ?></option>
                    <?php endforeach; ?>
                </select>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Save Changes</button>
            </div>

        </form>
    </div>
</div>


<script>
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('editId').value = btn.dataset.id;
            document.getElementById('editMovie').value = btn.dataset.movie;
            document.getElementById('editCast').value = btn.dataset.cast;
            document.getElementById('editRole').value = btn.dataset.role;

            new bootstrap.Modal(
                document.getElementById('editCastContentModal')
            ).show();
        });
    });
</script>