<?php

class MovieController extends Controller
{
    private Movie $movie;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->movie = $this->model('Movie');
    }

    public function index()
    {
        $movies = $this->movie->all();

        $this->view("Admin/movies/index", [
            "layout" => "admin",
            "movies" => $movies
        ]);
    }

    public function store()
    {
        $this->movie->create([
            "title"          => $_POST['title'],
            "description"    => $_POST['description'],
            "release_year"   => $_POST['release_year'],
            "language"       => $_POST['language'],
            "type"           => $_POST['type'],
            "movie_url"      => $_POST['movie_url'],
            "trailer_url"    => $_POST['trailer_url'],
            "banner_url"     => $_POST['banner_url'],
            "poster_url"     => $_POST['poster_url'],
            "is_free"        => $_POST['is_free'] ?? 0,
            "is_new_release" => $_POST['is_new_release'] ?? 0,
            "is_feature"     => $_POST['is_feature'] ?? 0,
            "is_banner"      => $_POST['is_banner'] ?? 0,
            "genre_id"       => $_POST['genre_id'],
        ]);

        $this->redirect("admin/movies");
    }

    public function update()
    {
        $this->movie->update($_POST['id'], $_POST);
        $this->redirect("admin/movies");
    }

    public function delete()
    {
        $this->movie->delete($_POST['id']);
        $this->redirect("admin/movies");
    }
}
