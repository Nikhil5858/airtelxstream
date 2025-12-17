<?php
require_once ROOT_PATH . 'app/models/Genre.php';
require_once ROOT_PATH . 'app/models/Movie.php';
class HomeController extends Controller
{
    public function index()
    {
        $genreModel = new Genre();
        $movieModel = new Movie();
        $sectionModel = $this->model('HomepageSection');

        $genres      = $genreModel->all();
        $banners     = $movieModel->getBannerMovies();
        $newReleases = $movieModel->getNewReleases();
        $sections = $sectionModel->allActive();

        foreach ($sections as &$section) {
            $section['movies'] = $movieModel->getBySection($section['id']);
        }

        $this->view("Frontend/home/index", [
            'genres'      => $genres,
            'banners'     => $banners,
            'newReleases' => $newReleases,
            'sections' => $sections
        ]);
    }
}

