<?php

class Episode
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function allWithSeason(): array
    {
        return $this->db->query("
            SELECT 
                e.*,
                s.season_number,
                m.title AS series
            FROM episodes e
            INNER JOIN seasons s ON s.id = e.season_id
            INNER JOIN movies m ON m.id = s.movie_id
            ORDER BY s.id, e.episode_number
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countBySeason(int $seasonId): int
    {
        return (int)$this->db
            ->query("SELECT COUNT(*) FROM episodes WHERE season_id = $seasonId")
            ->fetchColumn();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO episodes
            (season_id, episode_number, title, description, video_url, poster_img, created_at)
            VALUES
            (:sid, :eno, :title, :desc, :video, :poster, NOW())
        ");

        return $stmt->execute([
            'sid'    => $data['season_id'],
            'eno'    => $data['episode_number'],
            'title'  => $data['title'],
            'desc'   => $data['description'],
            'video'  => $data['video_url'],
            'poster' => $data['poster_img']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE episodes SET
                episode_number = :eno,
                title          = :title,
                description    = :desc,
                video_url      = :video,
                poster_img     = :poster
            WHERE id = :id
        ");

        return $stmt->execute([
            'id'     => $id,
            'eno'    => $data['episode_number'],
            'title'  => $data['title'],
            'desc'   => $data['description'],
            'video'  => $data['video_url'],
            'poster' => $data['poster_img']
        ]);
    }

    public function delete(int $id): bool
    {
        return $this->db
            ->prepare("DELETE FROM episodes WHERE id = :id")
            ->execute(['id' => $id]);
    }
}
