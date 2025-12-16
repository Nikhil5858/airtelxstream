<?php

class CastContentController extends Controller
{
    private CastContent $castContent;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->castContent = $this->model('CastContent');
    }

    public function index()
    {
        $this->view('Admin/cast_content/index', [
            'layout' => 'admin',
            'items'  => $this->castContent->all(),
            'movies' => $this->model('Movie')->all(),
            'casts'  => $this->model('Cast')->all(),
            'roles'  => $this->model('CastRole')->all()
        ]);
    }

    public function store()
    {
        if (
            empty($_POST['movie_id']) ||
            empty($_POST['cast_id']) ||
            empty($_POST['cast_roles_id'])
        ) {
            $this->redirect('admin/cast_content');
            return;
        }

        $this->castContent->create($_POST);
        $this->redirect('admin/cast_content');
    }

    public function update()
    {
        if (empty($_POST['id'])) {
            $this->redirect('admin/cast_content');
            return;
        }

        $this->castContent->update((int)$_POST['id'], $_POST);
        $this->redirect('admin/cast_content');
    }

    public function delete()
    {
        if (!empty($_POST['id'])) {
            $this->castContent->delete((int)$_POST['id']);
        }

        $this->redirect('admin/cast_content');
    }
}
