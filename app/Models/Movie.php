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
        $stmt = $this->db->prepare("
            UPDATE movies SET
                title=:title,
                description=:description,
                release_year=:release_year,
                language=:language,
                type=:type,
                banner_url=:banner_url,
                poster_url=:poster_url,
                is_free=:is_free,
                is_new_release=:is_new_release,
                is_feature=:is_feature,
                is_banner=:is_banner,
                genre_id=:genre_id,
                updated_at=NOW()
            WHERE id=:id
        ");

        return $stmt->execute([
            'id'             => $id,
            'title'          => $data['title'],
            'description'    => $data['description'] ?? null,
            'release_year'   => $data['release_year'] ?? null,
            'language'       => $data['language'] ?? null,
            'type'           => $data['type'] ?? 'movie',
            'poster_url'     => $data['poster_url'] ?? null,
            'banner_url'     => $data['banner_url'] ?? null,
            'is_free'        => $data['is_free'] ?? 0,
            'is_new_release' => $data['is_new_release'] ?? 0,
            'is_feature'     => $data['is_feature'] ?? 0,
            'is_banner'      => $data['is_banner'] ?? 0,
            'genre_id'       => $data['genre_id']
        ]);
    }


    public function delete(int $id): bool
    {
        return $this->db
            ->prepare("DELETE FROM movies WHERE id=?")
            ->execute([$id]);
    }

    public function getBannerMovies(): array
    {
        $stmt = $this->db->query("
            SELECT 
                m.id,
                m.title,
                m.language,
                m.movie_url,
                m.trailer_url,
                m.banner_url,
                g.name AS genre
            FROM movies m
            LEFT JOIN genres g ON g.id = m.genre_id
            WHERE m.is_banner = 1
            ORDER BY m.id DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
