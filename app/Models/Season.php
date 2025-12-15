<?php

class Season
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all(): array
    {
        $sql = "
            SELECT
                s.id,
                s.movie_id,
                m.title AS movie_title,
                CONCAT('Season ', s.season_number) AS season_name,
                s.season_number,
                s.episode_number AS total_episodes,
                s.release_year,
                s.genre_id,
                s.ott_id,
                o.name AS ott,
                g.name AS genre
            FROM seasons s
            INNER JOIN movies m 
                ON m.id = s.movie_id
               AND m.type = 'series'
            LEFT JOIN genres g 
                ON g.id = s.genre_id
            LEFT JOIN ott_providers o 
                ON o.id = s.ott_id
            ORDER BY s.id DESC
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO seasons
                (movie_id, season_number, episode_number, release_year, genre_id, ott_id)
            VALUES
                (:movie_id, :season_number, :episode_number, :release_year, :genre_id, :ott_id)
        ");

        return $stmt->execute([
            'movie_id'       => $data['movie_id'],
            'season_number'  => $data['season_number'],
            'episode_number' => $data['episode_number'],
            'release_year'   => $data['release_year'],
            'genre_id'       => $data['genre_id'],
            'ott_id'         => $data['ott_id']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE seasons SET
                movie_id       = :movie_id,
                season_number  = :season_number,
                episode_number = :episode_number,
                release_year   = :release_year,
                genre_id       = :genre_id,
                ott_id         = :ott_id
            WHERE id = :id
        ");

        return $stmt->execute([
            'id'             => $id,
            'movie_id'       => $data['movie_id'],
            'season_number'  => $data['season_number'],
            'episode_number' => $data['episode_number'],
            'release_year'   => $data['release_year'],
            'genre_id'       => $data['genre_id'],
            'ott_id'         => $data['ott_id']
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM seasons WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function allSeries(): array
    {
        $stmt = $this->db->query("
            SELECT id, title, genre_id, ott_id
            FROM movies
            WHERE type = 'series'
            ORDER BY title ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
