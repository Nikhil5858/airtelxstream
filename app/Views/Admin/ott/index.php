<?php /** @var array $otts */ ?>

<div class="main-content">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-start mt-1">
            <div>
                <h3>OTT Providers</h3>
                <p class="text-muted">Manage OTT platforms</p>
            </div>

            <button class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#addOttModal">
                <i class="bi bi-plus-lg"></i> Add OTT
            </button>
        </div>

        <div class="card mt-3">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Logo URL</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($otts as $o): ?>
                    <tr>
                        <td><?= $o['id'] ?></td>
                        <td><strong><?= htmlspecialchars($o['name']) ?></strong></td>
                        <td>
                            <?php if ($o['logo_url']): ?>
                                <img src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($o['logo_url']) ?>"
                                    alt="<?= htmlspecialchars($o['name']) ?>"
                                    style="height:40px">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $o['is_active'] ? 'Active' : 'Inactive' ?>
                        </td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm edit-btn"
                                    data-id="<?= $o['id'] ?>"
                                    data-name="<?= htmlspecialchars($o['name']) ?>"
                                    data-logo="<?= htmlspecialchars($o['logo_url']) ?>"
                                    data-active="<?= $o['is_active'] ?>">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button class="btn btn-outline-danger btn-sm delete-btn"
                                    data-id="<?= $o['id'] ?>"
                                    data-name="<?= htmlspecialchars($o['name']) ?>">
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
<div class="modal fade" id="addOttModal">
    <div class="modal-dialog">
        <form method="POST" action="<?= BASE_URL ?>/admin/ott/store" enctype="multipart/form-data" class="modal-content">

            <div class="modal-header">
                <h5>Add OTT</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label">Name</label>
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <input type="text" name="name" class="form-control mb-3" data-required="true" data-error="Ott Name is required">
                
                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label">Logo</label>
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <input type="file"
                    name="logo"
                    class="form-control mb-3"
                    data-required="true" data-error="Ott Image is required"
                    accept="image/*">

                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" checked>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editOttModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST"
              action="<?= BASE_URL ?>/admin/ott/update"
              enctype="multipart/form-data"
              class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit OTT</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" name="id" id="editOttId">

                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label">Name</label>
                    <span class="error-message text-danger small d-none"></span>
                </div>
                <input type="text"
                       name="name"
                       id="editOttName"
                       data-required="true" data-error="Ott Name is required"
                       class="form-control mb-3">

                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label">Logo</label>
                    <span class="error-message text-danger small d-none"></span>
                </div>
                
                <input type="file"
                       name="logo"
                       data-required="true" data-error="Ott Logo is required"
                       class="form-control mb-3"
                       accept="image/*">

                <div class="form-check">
                    <input type="checkbox"
                           name="is_active"
                           id="editOttActive"
                           class="form-check-input">
                    <label class="form-check-label">Active</label>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>
                <button class="btn btn-primary">Update</button>
            </div>

        </form>
    </div>
</div>

<!-- DELETE OTT MODAL -->
<div class="modal fade" id="deleteOttModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST"
              action="<?= BASE_URL ?>/admin/ott/delete"
              class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger">Delete OTT</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" name="id" id="deleteOttId">

                <p>Are you sure you want to delete this OTT platform?</p>
                <p class="fw-bold text-danger mb-0" id="deleteOttName"></p>

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


<script>
    /* EDIT */
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('editOttId').value   = btn.dataset.id;
            document.getElementById('editOttName').value = btn.dataset.name;
            document.getElementById('editOttActive').checked = btn.dataset.active == 1;

            new bootstrap.Modal(
                document.getElementById('editOttModal')
            ).show();
        });
    });

    /* DELETE */
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('deleteOttId').value   = btn.dataset.id;
            document.getElementById('deleteOttName').innerText = btn.dataset.name;

            new bootstrap.Modal(
                document.getElementById('deleteOttModal')
            ).show();
        });
    });
</script>
