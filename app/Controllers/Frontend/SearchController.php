<?php

class SearchController extends Controller
{
    private Movie $movie;

    public function __construct()
    {
        $this->movie = $this->model('Movie');
    }

    /** Search page */
    public function index()
    {
        $trending = $this->movie->getTrending();

        $this->view("Frontend/search/index", [
            'trending' => $trending
        ]);
    }

    /** AJAX search */
    public function results()
    {
        $query = trim($_GET['q'] ?? '');

        if ($query === '') {
            echo json_encode([]);
            return;
        }

        $results = $this->movie->search($query);

        header('Content-Type: application/json');
        echo json_encode($results);
    }
}
