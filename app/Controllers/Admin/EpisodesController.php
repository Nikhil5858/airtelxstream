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
            'layout'  => 'admin',
            'seasons' => $this->season->allWithEpisodeUsage(),
            'episodes'=> $this->episode->allWithSeason()
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

        $limit = $this->season->getEpisodeLimit($seasonId);
        $count = $this->episode->countBySeason($seasonId);

        if ($count >= $limit) {
            $this->redirect('admin/episodes');
            return;
        }

        $this->episode->create([
            'season_id'      => $seasonId,
            'episode_number' => $epNo,
            'title'          => $title,
            'description'    => $_POST['description'] ?? '',
            'video_url'      => $_POST['video_url'] ?? ''
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

    public function update()
    {
        $id      = (int)($_POST['id'] ?? 0);
        $epNo    = (int)($_POST['episode_number'] ?? 0);
        $title   = trim($_POST['title'] ?? '');

        if ($id <= 0 || $epNo <= 0 || $title === '') {
            $this->redirect('admin/episodes');
            return;
        }

        $this->episode->update($id, [
            'episode_number' => $epNo,
            'title'          => $title,
            'description'    => $_POST['description'] ?? '',
            'video_url'      => $_POST['video_url'] ?? ''
        ]);

        $this->redirect('admin/episodes');
    }

}
