<?php

class CastController extends Controller
{
    private Cast $cast;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->cast = $this->model('Cast');
    }

    public function index()
    {
        $this->view('Admin/cast/index', [
            'layout' => 'admin',
            'casts'  => $this->cast->all()
        ]);
    }

    public function store()
    {
        if (empty($_POST['name']) || empty($_FILES['image']['name'])) {
            $this->redirect('admin/cast');
            return;
        }

        $img = $this->uploadImage($_FILES['image']);

        $this->cast->create([
            'name' => trim($_POST['name']),
            'profile_image_url' => $img,
            'bio' => $_POST['bio'] ?? '',
            'date_of_birth' => $_POST['date_of_birth'] ?? null
        ]);

        $this->redirect('admin/cast');
    }

    public function update()
    {
        if (empty($_POST['id']) || empty($_POST['name'])) {
            $this->redirect('admin/cast');
            return;
        }

        $img = $_POST['old_image'];

        if (!empty($_FILES['image']['name'])) {
            $img = $this->uploadImage($_FILES['image']);
        }

        $this->cast->update((int)$_POST['id'], [
            'name' => trim($_POST['name']),
            'profile_image_url' => $img,
            'bio' => $_POST['bio'] ?? '',
            'date_of_birth' => $_POST['date_of_birth'] ?? null
        ]);

        $this->redirect('admin/cast');
    }

    public function delete()
    {
        if (!empty($_POST['id'])) {
            $this->cast->delete((int)$_POST['id']);
        }

        $this->redirect('admin/cast');
    }

    private function uploadImage(array $file): string
    {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $name = uniqid('cast_') . '.' . $ext;

        move_uploaded_file(
            $file['tmp_name'],
            ROOT_PATH . 'public/assets/images/' . $name
        );

        return $name;
    }
}
