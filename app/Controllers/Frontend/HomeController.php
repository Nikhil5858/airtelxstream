<?php
require_once ROOT_PATH . 'app/models/Genre.php';
require_once ROOT_PATH . 'app/models/Movie.php';
class HomeController extends Controller
{
    public function index()
    {
        $genreModel = new Genre();
        $movieModel = new Movie();

        $genres      = $genreModel->all();
        $banners     = $movieModel->getBannerMovies();
        $newReleases = $movieModel->getNewReleases();

        $this->view("Frontend/home/index", [
            'genres'      => $genres,
            'banners'     => $banners,
            'newReleases' => $newReleases
        ]);
    }
}

