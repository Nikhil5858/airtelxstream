<?php

class CastRoleController extends Controller
{
    private CastRole $role;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->role = $this->model('CastRole');
    }

    public function index()
    {
        $this->view('Admin/cast_roles/index', [
            'layout' => 'admin',
            'roles'  => $this->role->all()
        ]);
    }

    public function store()
    {
        $name = trim($_POST['role_name'] ?? '');

        if ($name === '') {
            $this->redirect('admin/cast_roles');
            return;
        }

        $this->role->create($name);
        $this->redirect('admin/cast_roles');
    }

    public function update()
    {
        $id   = (int)($_POST['id'] ?? 0);
        $name = trim($_POST['role_name'] ?? '');

        if ($id <= 0 || $name === '') {
            $this->redirect('admin/cast_roles');
            return;
        }

        $this->role->update($id, $name);
        $this->redirect('admin/cast_roles');
    }

    public function delete()
    {
        $id = (int)($_POST['id'] ?? 0);

        if ($id > 0) {
            $this->role->delete($id);
        }

        $this->redirect('admin/cast_roles');
    }
}
