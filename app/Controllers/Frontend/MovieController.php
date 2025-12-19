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

        // ✅ THIS WAS THE MISSING PART FOR SERIES
        $cast = $movieModel->getCastByMovie($id);

        // OPTIONAL: for series
        $seasons = [];
        $episodes = [];

        if ($movie['type'] === 'series') {
            $seasonModel  = $this->model('Season');
            $episodeModel = $this->model('Episode');

            $seasons  = $seasonModel->getByMovie($id);
            $episodes = $episodeModel->getByMovie($id);
        }

        $this->view('Frontend/movie/show', [
            'movie'    => $movie,
            'cast'     => $cast,      // 🔥 REQUIRED
            'seasons'  => $seasons,
            'episodes' => $episodes
        ]);
    }
}
