<?php

class HomepageSectionController extends Controller
{
    private HomepageSection $section;
    private Movie $movie;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->section = $this->model('HomepageSection');
        $this->movie   = $this->model('Movie');
    }

    /** List all homepage sections */
    public function index()
    {
        $sections = $this->section->all();

        $this->view("Admin/homepage_sections/index", [
            "layout"   => "admin",
            "sections" => $sections
        ]);
    }

    /** Store new homepage section */
    public function store()
    {
        $title  = trim($_POST['title'] ?? '');
        $type   = trim($_POST['type'] ?? 'slider');
        $active = isset($_POST['is_active']) ? 1 : 0;

        if ($title === '') {
            $this->redirect('admin/homepage_sections');
        }

        // auto position
        $position = $this->section->getNextPosition();

        $this->section->create([
            'title'     => $title,
            'type'      => $type,
            'position'  => $position,
            'is_active' => $active
        ]);

        $this->redirect('admin/homepage_sections');
    }


    /** Update homepage section */
    public function update()
    {
        $id       = (int)($_POST['id'] ?? 0);
        $title    = trim($_POST['title'] ?? '');
        $type     = trim($_POST['type'] ?? 'slider');
        $position = (int)($_POST['position'] ?? 0);
        $active   = isset($_POST['is_active']) ? 1 : 0;

        if ($id <= 0 || $title === '' || $position <= 0) {
            $this->redirect('admin/homepage_sections');
        }

        $this->section->update($id, [
            'title'     => $title,
            'type'      => $type,
            'position'  => $position,
            'is_active' => $active
        ]);

        $this->redirect('admin/homepage_sections');
    }

    /** Delete homepage section */
    public function delete()
    {
        $id = (int)($_POST['id'] ?? 0);

        if ($id <= 0) {
            $this->redirect('admin/homepage_sections');
        }

        $this->section->delete($id);
        $this->redirect('admin/homepage_sections');
    }

    /** Show movie selection page for a section */
    public function movies()
    {
        $sectionId = (int)($_GET['id'] ?? 0);

        if ($sectionId <= 0) {
            $this->redirect('admin/homepage_sections');
        }

        $section = $this->section->find($sectionId);

        // ALL movies (left column)
        $allMovies = $this->movie->all();

        // SELECTED movies in correct order (right column)
        $sectionMovies = $this->movie->getBySection($sectionId);

        $this->view("Admin/homepage_sections/movies", [
            "layout"        => "admin",
            "section"       => $section,
            "allMovies"     => $allMovies,
            "sectionMovies" => $sectionMovies
        ]);
    }

    public function reorder()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!is_array($data)) {
            http_response_code(400);
            return;
        }

        $this->section->reorder($data);
    }


    /** Save selected movies for a section */
    public function saveMovies()
    {
        $sectionId = (int)($_POST['section_id'] ?? 0);
        $movieIds  = $_POST['movies'] ?? [];

        if ($sectionId <= 0) {
            $this->redirect('admin/homepage_sections');
        }

        $this->section->syncMovies($sectionId, $movieIds);
        $this->redirect('admin/homepage_sections');
    }
}
