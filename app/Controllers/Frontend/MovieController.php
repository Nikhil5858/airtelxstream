<?php
class MovieController extends Controller
{
    public function show()
    {
        if (!isset($_GET['id'])) {
            die('Movie ID missing');
        }

        $id = (int) $_GET['id'];
        $userId = $_SESSION['user_id'] ?? 0;

        $movieModel = $this->model('Movie');

        $movie = $movieModel->find($id, $userId);
        if (!$movie) {
            die('Movie not found');
        }

        $cast = $movieModel->getCastByMovie($id);

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
            'cast'     => $cast,
            'seasons'  => $seasons,
            'episodes' => $episodes
        ]);
    }
}
