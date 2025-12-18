<?php
require_once ROOT_PATH . 'app/models/Movie.php';
class MovieController extends Controller
{
    public function show()
    {
        if (!isset($_GET['id'])) {
            die('Movie ID missing');
        }

        $id = (int) $_GET['id'];

        $movieModel = $this->model('Movie');

        $movie = $movieModel->find($id);
        if (!$movie) {
            die('Movie not found');
        }

        // FETCH CAST
        $cast = $movieModel->getCastByMovie($id);

        $this->view('Frontend/movie/show', [
            'movie' => $movie,
            'cast'  => $cast
        ]);
    }

}
