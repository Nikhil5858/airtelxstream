<?php

class Watchlist
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /** Get user's watchlist movies */
    public function getUserWatchlist(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT 
                m.id,
                m.title,
                m.poster_url,
                m.type,
                m.is_free
            FROM watchlist w
            INNER JOIN movies m ON m.id = w.movie_id
            WHERE w.user_id = :uid
            ORDER BY w.added_at DESC
        ");

        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add(int $userId, int $movieId): bool
    {
        $stmt = $this->db->prepare("
            INSERT IGNORE INTO watchlist (user_id, movie_id)
            VALUES (:uid, :mid)
        ");

        return $stmt->execute([
            'uid' => $userId,
            'mid' => $movieId
        ]);
    }


    public function remove(int $userId, int $movieId): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM watchlist
            WHERE user_id = :uid AND movie_id = :mid
        ");

        return $stmt->execute([
            'uid' => $userId,
            'mid' => $movieId
        ]);
    }

}
