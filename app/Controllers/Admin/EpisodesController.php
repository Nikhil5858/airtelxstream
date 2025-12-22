<?php

class EpisodesController extends Controller
{
    private Episode $episode;
    private Season $season;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->episode = $this->model('Episode');
        $this->season  = $this->model('Season');
    }

    public function index()
    {
        $this->view('Admin/episodes/index', [
            'layout'   => 'admin',
            'seasons'  => $this->season->allWithEpisodeUsage(),
            'episodes' => $this->episode->allWithSeason()
        ]);
    }

    public function store()
    {
        $seasonId = (int)($_POST['season_id'] ?? 0);
        $epNo     = (int)($_POST['episode_number'] ?? 0);
        $title    = trim($_POST['title'] ?? '');

        if ($seasonId <= 0 || $epNo <= 0 || $title === '') {
            $this->redirect('admin/episodes');
            return;
        }

        $posterName = null;
        if (!empty($_FILES['poster_img']['name'])) {
            $posterName = time().'_'.$_FILES['poster_img']['name'];
            move_uploaded_file(
                $_FILES['poster_img']['tmp_name'],
                ROOT_PATH.'public/assets/images/'.$posterName
            );
        }

        $videoName = null;
        if (!empty($_FILES['video_file']['name'])) {
            $videoName = time().'_'.$_FILES['video_file']['name'];
            move_uploaded_file(
                $_FILES['video_file']['tmp_name'],
                ROOT_PATH.'public/assets/videos/'.$videoName
            );
        }

        $this->episode->create([
            'season_id'      => $seasonId,
            'episode_number' => $epNo,
            'title'          => $title,
            'description'    => $_POST['description'] ?? '',
            'video_url'      => $videoName,
            'poster_img'     => $posterName
        ]);

        $this->redirect('admin/episodes');
    }

    public function update()
    {
        $id    = (int)($_POST['id'] ?? 0);
        $epNo  = (int)($_POST['episode_number'] ?? 0);
        $title = trim($_POST['title'] ?? '');

        if ($id <= 0 || $epNo <= 0 || $title === '') {
            $this->redirect('admin/episodes');
            return;
        }

        $posterName = $_POST['old_poster'] ?? null;
        if (!empty($_FILES['poster_img']['name'])) {
            $posterName = time().'_'.$_FILES['poster_img']['name'];
            move_uploaded_file(
                $_FILES['poster_img']['tmp_name'],
                ROOT_PATH.'public/assets/images/'.$posterName
            );
        }

        $videoName = $_POST['old_video'] ?? null;
        if (!empty($_FILES['video_file']['name'])) {
            $videoName = time().'_'.$_FILES['video_file']['name'];
            move_uploaded_file(
                $_FILES['video_file']['tmp_name'],
                ROOT_PATH.'public/assets/videos/'.$videoName
            );
        }

        $this->episode->update($id, [
            'episode_number' => $epNo,
            'title'          => $title,
            'description'    => $_POST['description'] ?? '',
            'video_url'      => $videoName,
            'poster_img'     => $posterName
        ]);

        $this->redirect('admin/episodes');
    }

    public function delete()
    {
        if (!empty($_POST['id'])) {
            $this->episode->delete((int)$_POST['id']);
        }
        $this->redirect('admin/episodes');
    }
}
