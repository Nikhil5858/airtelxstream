<?php

class OttController extends Controller
{
    private Ott $ott;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->ott = $this->model('Ott');
    }

    public function index()
    {
        $this->view("Admin/ott/index", [
            'layout' => 'admin',
            'otts'   => $this->ott->all()
        ]);
    }

    public function store()
    {
        $name = trim($_POST['name'] ?? '');

        if ($name === '' || empty($_FILES['logo']['name'])) {
            $this->redirect('admin/ott');
            return;
        }

        $file     = $_FILES['logo'];
        $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('ott_') . '.' . $ext;

        $targetDir  = ROOT_PATH . 'public/assets/images/';
        $targetPath = $targetDir . $filename;

        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            $this->redirect('admin/ott');
            return;
        }

        $this->ott->create([
            'name'      => $name,
            'logo_url'  => $filename, // STORE FILE NAME
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ]);

        $this->redirect('admin/ott');
    }


    public function update()
    {
        $id   = (int) ($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');

        if ($id <= 0 || $name === '') {
            $this->redirect('admin/ott');
            return;
        }

        $logo = null;

        if (!empty($_FILES['logo']['name'])) {
            $ext      = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $logo     = uniqid('ott_') . '.' . $ext;
            $path     = ROOT_PATH . 'public/assets/images/' . $logo;

            move_uploaded_file($_FILES['logo']['tmp_name'], $path);
        }

        $this->ott->update($id, [
            'name'      => $name,
            'logo_url'  => $logo ?? $_POST['existing_logo'] ?? '',
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ]);

        $this->redirect('admin/ott');
    }


    public function delete()
    {
        $id = (int) ($_POST['id'] ?? 0);

        if ($id > 0) {
            $this->ott->delete($id);
        }

        $this->redirect('admin/ott');
    }
}
