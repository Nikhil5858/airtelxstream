<?php

require_once ROOT_PATH . 'app/models/Movie.php';
require_once ROOT_PATH . 'app/models/OttProvider.php';

class OttController extends Controller
{
    public function index()
    {
        $userId = $_SESSION['user_id'] ?? 0;

        $movieModel = $this->model('Movie');
        $ottModel   = $this->model('OttProvider');

        $otts = $ottModel->allActive();

        foreach ($otts as &$ott) {
            $ott['movies'] = $movieModel->getByOtt(
                (int)$ott['id'],
                $userId
            );
        }

        // Remove OTTs with no movies
        $otts = array_filter($otts, fn ($ott) => !empty($ott['movies']));

        $this->view("Frontend/ott/index", [
            'otts' => $otts
        ]);
    }
}
