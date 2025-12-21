<?php

class SeeallController extends Controller
{
    public function show()
    {
        if (!isset($_GET['id'])) {
            die('Section ID missing');
        }

        $sectionId = (int) $_GET['id'];
        $userId    = $_SESSION['user_id'] ?? 0;

        $sectionModel = $this->model('HomepageSection');
        $movieModel   = $this->model('Movie');

        $section = $sectionModel->find($sectionId);
        if (!$section) {
            die('Section not found');
        }

        $movies = $movieModel->getBySection($sectionId, $userId);

        $this->view('Frontend/seeall/show', [
            'title'  => $section['title'],
            'movies' => $movies
        ]);
    }

    public function newReleases()
    {
        $userId = $_SESSION['user_id'] ?? 0;

        $movieModel = $this->model('Movie');

        $movies = $movieModel->getNewReleases($userId, 1000);

        $this->view('Frontend/seeall/show', [
            'title'  => 'New Releases',
            'movies' => $movies
        ]);
    }
}
