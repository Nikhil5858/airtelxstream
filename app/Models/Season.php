<?php

class Season
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /** Fetch all seasons with relations */
    public function all(): array
    {
        $stmt = $this->db->query("
            SELECT 
            s.*,
            m.title AS movie,
            g.name  AS genre,
            o.name  AS ott,
            COUNT(e.id) AS total_episodes
            FROM seasons s
            LEFT JOIN movies m ON m.id = s.movie_id
            LEFT JOIN genres g ON g.id = s.genre_id
            LEFT JOIN ott_providers o ON o.id = s.ott_id
            LEFT JOIN episodes e ON e.season_id = s.id
            GROUP BY s.id
        ");

        return $stmt->fetchAll();
    }

    /** Create season */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO seasons
            (movie_id, season_number, episodes, release_year, genre_id, ott_id)
            VALUES
            (:movie_id, :season_number, :episodes, :release_year, :genre_id, :ott_id)
        ");

        return $stmt->execute($data);
    }

    /** Update season */
    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;

        $stmt = $this->db->prepare("
            UPDATE seasons SET
                movie_id = :movie_id,
                season_number = :season_number,
                episodes = :episodes,
                release_year = :release_year,
                genre_id = :genre_id,
                ott_id = :ott_id
            WHERE id = :id
        ");

        return $stmt->execute($data);
    }

    /** Delete season */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM seasons WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
