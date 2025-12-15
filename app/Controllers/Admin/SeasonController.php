<?php

class SeasonController extends Controller
{
    private Season $season;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->season = $this->model('Season');
    }

    public function index()
    {
        $this->view("Admin/seasons/index", [
            'layout'  => 'admin',
            'seasons' => $this->season->all(),
            'movies'  => $this->season->allSeries(),
            'genres'  => $this->model('Genre')->all(),
            'otts'    => $this->model('Ott')->all()
        ]);
    }

    public function store()
    {
        if (
            empty($_POST['movie_id']) ||
            empty($_POST['season_number']) ||
            empty($_POST['episode_number']) ||
            empty($_POST['release_year'])
        ) {
            $this->redirect('admin/seasons');
            return;
        }

        $this->season->create([
            'movie_id'       => (int) $_POST['movie_id'],
            'season_number'  => (int) $_POST['season_number'],
            'episode_number' => (int) $_POST['episode_number'],
            'release_year'   => (int) $_POST['release_year'],
            'genre_id'       => $_POST['genre_id'] ?? null,
            'ott_id'         => $_POST['ott_id'] ?? null
        ]);

        $this->redirect('admin/seasons');
    }

    public function update()
    {
        if (empty($_POST['id'])) {
            $this->redirect('admin/seasons');
            return;
        }

        $this->season->update((int) $_POST['id'], [
            'movie_id'       => (int) $_POST['movie_id'],
            'season_number'  => (int) $_POST['season_number'],
            'episode_number' => (int) $_POST['episode_number'],
            'release_year'   => (int) $_POST['release_year'],
            'genre_id'       => $_POST['genre_id'] ?? null,
            'ott_id'         => $_POST['ott_id'] ?? null
        ]);

        $this->redirect('admin/seasons');
    }

    public function delete()
    {
        if (!empty($_POST['id'])) {
            $this->season->delete((int) $_POST['id']);
        }

        $this->redirect('admin/seasons');
    }
}
