<?php
require_once ROOT_PATH . 'app/models/Genre.php';
require_once ROOT_PATH . 'app/models/Movie.php';

class FreeController extends Controller
{
    public function index()
    {
        $genreModel = new Genre();
        $movieModel = new Movie();
        $sectionModel = $this->model('HomepageSection');

        $genres      = $genreModel->all();
        $banners     = $movieModel->getBannerMovies();
        $sections = $sectionModel->allActive();

        foreach ($sections as &$section) {
            $section['movies'] = $movieModel->getFreeBySection($section['id']);
        }

        $this->view("Frontend/free/index", [
            'genres'      => $genres,
            'banners'     => $banners,
            'sections' => $sections
        ]);
    }
}

