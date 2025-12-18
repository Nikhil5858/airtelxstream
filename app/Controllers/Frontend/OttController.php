<?php

require_once ROOT_PATH . 'app/models/Movie.php';

class OttController extends Controller
{
    public function index()
    {
        $movieModel = new Movie();
        $ottModel   = $this->model('OttProvider');
        $otts = $ottModel->allActive();

        foreach ($otts as &$ott) {
            $ott['movies'] = $movieModel->getByOtt((int)$ott['id']);
        }

        $otts = array_filter($otts, function ($ott) {
            return !empty($ott['movies']);
        });

        $this->view("Frontend/ott/index", [
            'otts' => $otts
        ]);
    }
}
