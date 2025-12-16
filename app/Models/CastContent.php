<?php

class CastContent
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
                cc.id,
                m.id AS movie_id,
                m.title AS movie_title,
                c.id AS cast_id,
                c.name AS cast_name,
                cr.id AS role_id,
                cr.role_name
            FROM cast_content cc
            INNER JOIN movies m ON m.id = cc.movie_id
            INNER JOIN `cast` c ON c.id = cc.cast_id
            INNER JOIN cast_roles cr ON cr.id = cc.cast_roles_id
            ORDER BY m.title
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO cast_content (movie_id, cast_id, cast_roles_id)
            VALUES (:movie, :cast, :role)
        ");

        return $stmt->execute([
            'movie' => $data['movie_id'],
            'cast'  => $data['cast_id'],
            'role'  => $data['cast_roles_id']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE cast_content SET
                movie_id = :movie,
                cast_id = :cast,
                cast_roles_id = :role
            WHERE id = :id
        ");

        return $stmt->execute([
            'id'    => $id,
            'movie' => $data['movie_id'],
            'cast'  => $data['cast_id'],
            'role'  => $data['cast_roles_id']
        ]);
    }

    public function delete(int $id): bool
    {
        return $this->db
            ->prepare("DELETE FROM cast_content WHERE id = :id")
            ->execute(['id' => $id]);
    }
}
