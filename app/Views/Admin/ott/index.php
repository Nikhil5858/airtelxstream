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
                        <td><?= htmlspecialchars($o['logo_url']) ?></td>
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
        <form method="POST" action="<?= BASE_URL ?>/admin/ott/store" class="modal-content">
            <div class="modal-header">
                <h5>Add OTT</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label>Name</label>
                <input type="text" name="name" class="form-control mb-3" required>

                <label>Logo URL</label>
                <input type="text" name="logo_url" class="form-control mb-3">

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
