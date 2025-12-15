<div class="main-content">
    <div class="container-fluid">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-start mt-1">
            <div>
                <h3>Users</h3>
                <p class="text-muted">Manage platform users</p>
            </div>

            <button class="btn btn-primary mt-2"
                    data-bs-toggle="modal"
                    data-bs-target="#addUserModal">
                <i class="bi bi-plus-lg me-2"></i> Add User
            </button>
        </div>

        <!-- TABLE -->
        <div class="card mt-3">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Subscription</th>
                        <th>Joined</th>
                        <th>Last Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($u['name']) ?></strong></td>

                            <td>
                                <?= $u['is_subscription_active']
                                    ? '<span class="badge bg-success-subtle text-success">Active</span>'
                                    : '<span class="badge bg-secondary-subtle text-dark">Inactive</span>' ?>
                            </td>

                            <td><?= date('d M Y', strtotime($u['created_at'])) ?></td>

                            <td>
                                <?= $u['last_login']
                                    ? date('d M Y H:i', strtotime($u['last_login']))
                                    : '—' ?>
                            </td>

                            <td>
                                <button class="btn btn-outline-primary btn-sm edit-btn"
                                        data-id="<?= $u['id'] ?>"
                                        data-name="<?= htmlspecialchars($u['name']) ?>"
                                        data-sub="<?= $u['is_subscription_active'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <button class="btn btn-outline-danger btn-sm delete-btn"
                                        data-id="<?= $u['id'] ?>"
                                        data-name="<?= htmlspecialchars($u['name']) ?>">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            No users found
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- ================= ADD USER MODAL ================= -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="<?= BASE_URL ?>/admin/users/store">

                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label">Name *</label>
                        <span class="error-message text-danger small d-none"></span>
                    </div>
                    <input type="text" name="name" class="form-control mb-3"
                           data-required="true"
                           data-error="User name is required">

                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label">Email *</label>
                        <span class="error-message text-danger small d-none"></span>
                    </div>
                    <input type="email" name="email" class="form-control mb-3"
                           data-required="true"
                           data-error="Email is required">

                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label">Password *</label>
                        <span class="error-message text-danger small d-none"></span>
                    </div>
                    <input type="password" name="password" class="form-control mb-3"
                           data-required="true"
                           data-error="Password is required">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="is_subscription_active" value="1">
                        <label class="form-check-label">Subscription Active</label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save User</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- ================= EDIT USER MODAL ================= -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="<?= BASE_URL ?>/admin/users/update">

                <input type="hidden" name="id" id="editId">

                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label">Name</label>
                        <span class="error-message text-danger small d-none"></span>
                    </div>
                    <input type="text" name="name" id="editName"
                           class="form-control mb-3"
                           data-required="true"
                           data-error="User name is required">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="is_subscription_active"
                               id="editSubscription" value="1">
                        <label class="form-check-label">Subscription Active</label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Update User</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- ================= DELETE USER MODAL ================= -->
<div class="modal fade" id="deleteUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger">Delete User</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="<?= BASE_URL ?>/admin/users/delete">
                <div class="modal-body">
                    <input type="hidden" name="id" id="deleteUserId">
                    <p>Are you sure you want to delete this user?</p>
                    <p class="fw-bold text-danger mb-0" id="deleteUserName"></p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
    function validateForm(form) {
        let valid = true;
        form.querySelectorAll("[data-required='true']").forEach(input => {
            const errorSpan = input.previousElementSibling.querySelector(".error-message");
            if (!input.value.trim()) {
                errorSpan.textContent = input.dataset.error;
                errorSpan.classList.remove("d-none");
                valid = false;
            } else {
                errorSpan.classList.add("d-none");
            }
        });
        return valid;
    }

    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("submit", e => {
            if (!validateForm(form)) e.preventDefault();
        });
    });

    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            editId.value = btn.dataset.id;
            editName.value = btn.dataset.name;
            editSubscription.checked = btn.dataset.sub === "1";
            new bootstrap.Modal(editUserModal).show();
        });
    });

    document.querySelectorAll(".delete-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            deleteUserId.value = btn.dataset.id;
            deleteUserName.innerText = btn.dataset.name;
            new bootstrap.Modal(deleteUserModal).show();
        });
    });
</script>
