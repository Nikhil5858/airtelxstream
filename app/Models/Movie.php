<?php

class Movie
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all(): array
    {
        return $this->db->query("
            SELECT 
            m.*,
            g.name AS genre,
            o.name AS ott
            FROM movies m
            LEFT JOIN genres g ON g.id = m.genre_id
            LEFT JOIN ott_providers o ON o.id = m.ott_id
            ORDER BY m.id DESC
        ")->fetchAll();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO movies 
            (title, description, release_year, language, type,
             movie_url, trailer_url, banner_url, poster_url,
             is_free, is_new_release, is_feature, is_banner,
             genre_id, created_at)
            VALUES
            (:title, :description, :release_year, :language, :type,
             :movie_url, :trailer_url, :banner_url, :poster_url,
             :is_free, :is_new_release, :is_feature, :is_banner,
             :genre_id, NOW())
        ");

        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;

        return $this->db->prepare("
            UPDATE movies SET
                title=:title,
                description=:description,
                release_year=:release_year,
                language=:language,
                type=:type,
                movie_url=:movie_url,
                trailer_url=:trailer_url,
                banner_url=:banner_url,
                poster_url=:poster_url,
                is_free=:is_free,
                is_new_release=:is_new_release,
                is_feature=:is_feature,
                is_banner=:is_banner,
                genre_id=:genre_id,
                updated_at=NOW()
            WHERE id=:id
        ")->execute($data);
    }

    public function delete(int $id): bool
    {
        return $this->db
            ->prepare("DELETE FROM movies WHERE id=?")
            ->execute([$id]);
    }
}
