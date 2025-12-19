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

        // fetch genres for dropdown
        $genres = $this->model('Genre')->all();
        $otts = $this->model('OttProvider')->allActive();

        $this->view("Admin/movies/index", [
            "layout" => "admin",
            "movies" => $movies,
            "genres" => $genres,
            "otts"   => $otts
        ]);

    }

    public function store()
    {
        // 1. Validate required fields
        if (empty($_POST['title'])) {
            die("Title is required");
        }

        // 2. Handle file uploads
        $posterName  = null;
        $bannerName  = null;
        $movieName   = null;
        $trailerName = null;

        if (!empty($_FILES['poster_file']['name'])) {
            $posterName = time() . '_' . $_FILES['poster_file']['name'];
            move_uploaded_file(
                $_FILES['poster_file']['tmp_name'],
                ROOT_PATH . 'public/assets/images/' . $posterName
            );
        }

        if (!empty($_FILES['banner_file']['name'])) {
            $bannerName = time() . '_' . $_FILES['banner_file']['name'];
            move_uploaded_file(
                $_FILES['banner_file']['tmp_name'],
                ROOT_PATH . 'public/assets/images/' . $bannerName
            );
        }

        if (!empty($_FILES['movie_file']['name'])) {
            $movieName = time() . '_' . $_FILES['movie_file']['name'];
            move_uploaded_file(
                $_FILES['movie_file']['tmp_name'],
                ROOT_PATH . 'public/assets/videos/' . $movieName
            );
        }

        if (!empty($_FILES['trailer_file']['name'])) {
            $trailerName = time() . '_' . $_FILES['trailer_file']['name'];
            move_uploaded_file(
                $_FILES['trailer_file']['tmp_name'],
                ROOT_PATH . 'public/assets/videos/' . $trailerName
            );
        }

        // 3. Insert into DB
        $this->movie->create([
            "title"          => $_POST['title'],
            "description"    => $_POST['description'] ?? null,
            "release_year"   => $_POST['release_year'] ?? null,
            "language"       => $_POST['language'] ?? null,
            "type"           => $_POST['type'] ?? 'movie',
            "ott_id"         => $_POST['ott_id'] ?? null,
            "movie_url"      => $movieName,
            "trailer_url"    => $trailerName,
            "poster_url"     => $posterName,
            "banner_url"     => $bannerName,
            "is_free"        => $_POST['is_free'] ?? 0,
            "is_new_release" => $_POST['is_new_release'] ?? 0,
            "is_feature"     => $_POST['is_feature'] ?? 0,
            "is_banner"      => $_POST['is_banner'] ?? 0,
            "genre_id"       => $_POST['genre_id']
        ]);

        $this->redirect("admin/movies");
    }


    public function update()
    {
        $posterName = $_POST['old_poster'] ?? null;
        $bannerName = $_POST['old_banner'] ?? null;

        if (!empty($_FILES['poster_file']['name'])) {
            $posterName = time().'_'.$_FILES['poster_file']['name'];
            move_uploaded_file(
                $_FILES['poster_file']['tmp_name'],
                ROOT_PATH.'public/assets/images/'.$posterName
            );
        }

        if (!empty($_FILES['banner_file']['name'])) {
            $bannerName = time().'_'.$_FILES['banner_file']['name'];
            move_uploaded_file(
                $_FILES['banner_file']['tmp_name'],
                ROOT_PATH.'public/assets/images/'.$bannerName
            );
        }

        $this->movie->update($_POST['id'], [
            'title'          => $_POST['title'],
            'description'    => $_POST['description'],
            'release_year'   => $_POST['release_year'],
            'language'       => $_POST['language'],
            'type'           => $_POST['type'],
            "ott_id"         => $_POST['ott_id'] ?? null,
            'poster_url'     => $posterName,
            'banner_url'     => $bannerName,
            'is_free'        => $_POST['is_free'] ?? 0,
            'is_new_release' => $_POST['is_new_release'] ?? 0,
            'is_feature'     => $_POST['is_feature'] ?? 0,
            'is_banner'      => $_POST['is_banner'] ?? 0,
            'genre_id'       => $_POST['genre_id']
        ]);

        $this->redirect("admin/movies");
    }


    public function delete()
    {
        $this->movie->delete($_POST['id']);
        $this->redirect("admin/movies");
    }
}
