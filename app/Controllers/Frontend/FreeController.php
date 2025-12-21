<?php

require_once ROOT_PATH . 'app/models/Genre.php';
require_once ROOT_PATH . 'app/models/Movie.php';

class FreeController extends Controller
{
    public function index()
    {
        $userId = $_SESSION['user_id'] ?? 0;

        $genreModel   = $this->model('Genre');
        $movieModel   = $this->model('Movie');
        $sectionModel = $this->model('HomepageSection');
        $ottModel   = $this->model('OttProvider');

        $banners  = $movieModel->getBannerMovies($userId);
        $genres   = $genreModel->all();
        $sections = $sectionModel->allActive();
        $otts = $ottModel->allActive();

        foreach ($sections as &$section) {
            $section['movies'] = $movieModel->getFreeBySection(
                $section['id'],
                $userId
            );
        }

        $this->view("Frontend/free/index", [
            'genres'   => $genres,
            'banners'  => $banners,
            'sections' => $sections,
            'otts'     => $otts
        ]);
    }
}
