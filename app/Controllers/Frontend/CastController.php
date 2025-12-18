<?php

class CastController extends Controller
{
    public function show()
    {
        if (!isset($_GET['id'])) {
            die('Cast ID missing');
        }

        $id = (int) $_GET['id'];

        $cast = $this->model('Cast')->find($id);

        if (!$cast) {
            die('Cast member not found');
        }

        $this->view('Frontend/cast/show', [
            'cast' => $cast
        ]);
    }
}
