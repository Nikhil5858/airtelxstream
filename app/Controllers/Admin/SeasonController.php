<?php

class SeasonController extends Controller
{
    private $season;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->season = $this->model('Season');
    }

    public function index()
    {
        $this->view("Admin/seasons/index", [
            "layout"  => "admin",
            "seasons" => $this->season->all()
        ]);
    }

    public function store()
    {
        $this->season->create([
            'movie_id'      => $_POST['movie_id'] ?? null,
            'season_number' => $_POST['season_number'],
            'episodes'      => $_POST['episodes'],
            'release_year'  => $_POST['release_year'],
            'genre_id'      => $_POST['genre_id'] ?? null,
            'ott_id'        => $_POST['ott_id'] ?? null
        ]);

        $this->redirect('admin/seasons');
    }

    public function update()
    {
        $this->season->update((int)$_POST['id'], [
            'movie_id'      => $_POST['movie_id'] ?? null,
            'season_number' => $_POST['season_number'],
            'episodes'      => $_POST['episodes'],
            'release_year'  => $_POST['release_year'],
            'genre_id'      => $_POST['genre_id'] ?? null,
            'ott_id'        => $_POST['ott_id'] ?? null
        ]);

        $this->redirect('admin/seasons');
    }

    public function delete()
    {
        $this->season->delete((int)$_POST['id']);
        $this->redirect('admin/seasons');
    }
}
