<?php

class GenreController extends Controller
{
    public function show()
    {
        if (!isset($_GET['id'])) {
            die('Genre ID missing');
        }

        $genreId = (int) $_GET['id'];
        $userId  = $_SESSION['user_id'] ?? 0;

        $genreModel   = $this->model('Genre');
        $sectionModel = $this->model('HomepageSection');
        $movieModel   = $this->model('Movie');

        $genre = $genreModel->find($genreId);
        if (!$genre) {
            die('Genre not found');
        }

        // Get all active sections
        $sections = $sectionModel->allActive();

        // Filter movies by genre INSIDE each section
        foreach ($sections as &$section) {
            $section['movies'] = $movieModel->getBySectionAndGenre(
                $section['id'],
                $genreId,
                $userId
            );
        }

        // Remove empty sections
        $sections = array_filter($sections, fn($s) => !empty($s['movies']));

        $this->view('Frontend/genre/show', [
            'genre'    => $genre,
            'sections' => $sections
        ]);
    }
}
