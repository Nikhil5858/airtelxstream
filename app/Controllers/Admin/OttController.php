<?php

class OttController extends Controller
{
    private Ott $ott;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->ott = $this->model('Ott');
    }

    /** List OTT providers */
    public function index()
    {
        $this->view("Admin/ott/index", [
            'layout' => 'admin',
            'otts'   => $this->ott->all()
        ]);
    }

    /** Store OTT */
    public function store()
    {
        $name = trim($_POST['name'] ?? '');

        if ($name === '') {
            $this->redirect('admin/ott');
            return;
        }

        $this->ott->create([
            'name'      => $name,
            'logo_url'  => trim($_POST['logo_url'] ?? ''),
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ]);

        $this->redirect('admin/ott');
    }

    /** Update OTT */
    public function update()
    {
        $id   = (int) ($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');

        if ($id <= 0 || $name === '') {
            $this->redirect('admin/ott');
            return;
        }

        $this->ott->update($id, [
            'name'      => $name,
            'logo_url'  => trim($_POST['logo_url'] ?? ''),
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ]);

        $this->redirect('admin/ott');
    }

    /** Delete OTT */
    public function delete()
    {
        $id = (int) ($_POST['id'] ?? 0);

        if ($id > 0) {
            $this->ott->delete($id);
        }

        $this->redirect('admin/ott');
    }
}
