<?php

class GenreController extends Controller
{
    private Genre $genre;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->genre = $this->model('Genre');
    }

    /** List genres */
    public function index()
    {
        $genres = $this->genre->all();

        $this->view("Admin/genres/index", [
            "layout" => "admin",
            "genres" => $genres
        ]);
    }

    /** Store genre */
    public function store()
    {
        $name = trim($_POST['name'] ?? '');

        if ($name === '') {
            $this->redirect('admin/genres');
        }

        $this->genre->create($name);
        $this->redirect('admin/genres');
    }

    /** Update genre */
    public function update()
    {
        $id   = (int)($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');

        if ($id <= 0 || $name === '') {
            $this->redirect('admin/genres');
        }

        $this->genre->update($id, $name);
        $this->redirect('admin/genres');
    }

    /** Delete genre */
    public function delete()
    {
        $id = (int)($_POST['id'] ?? 0);

        if ($id <= 0) {
            $this->redirect('admin/genres');
        }

        $this->genre->delete($id);
        $this->redirect('admin/genres');
    }
}
