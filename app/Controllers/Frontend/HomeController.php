<?php
require_once ROOT_PATH . 'app/models/Genre.php';
require_once ROOT_PATH . 'app/models/Movie.php';
class HomeController extends Controller
{
    public function index()
    {
        $userId = $_SESSION['user_id'] ?? 0;

        $movieModel   = $this->model('Movie');
        $genreModel   = $this->model('Genre');
        $sectionModel = $this->model('HomepageSection');

        $banners = $movieModel->getBannerMovies($userId);
        $genres = $genreModel->all();

        // Homepage sections
        $sections = $sectionModel->allActive();

        foreach ($sections as &$section) {
            $section['movies'] = $movieModel->getBySection(
                $section['id'],
                $userId
            );
        }

        
        // New Releases section
        $newReleases = $movieModel->getNewReleases($userId);

        $this->view("Frontend/home/index", [
            'banners'     => $banners,
            'genres'      => $genres,
            'sections'    => $sections,
            'newReleases' => $newReleases
        ]);
    }
}


