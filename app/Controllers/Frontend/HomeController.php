<?php
require_once ROOT_PATH . 'app/models/Genre.php';
class HomeController extends Controller
{
    public function index()
    {
        $genreModel = new Genre();
        $genres = $genreModel->all();

        $this->view("Frontend/home/index", [
            'genres' => $genres
        ]);
    }
}
