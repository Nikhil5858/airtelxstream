<?php

class Genre
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /** Fetch all genres */
    public function all(): array
    {
        $stmt = $this->db->query("
            SELECT id, name
            FROM genres
        ");

        return $stmt->fetchAll();
    }

    /** Create genre */
    public function create(string $name): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO genres (name)
            VALUES (:name)
        ");

        return $stmt->execute([
            'name' => $name
        ]);
    }

    /** Update genre */
    public function update(int $id, string $name): bool
    {
        $stmt = $this->db->prepare("
            UPDATE genres
            SET name = :name
            WHERE id = :id
        ");

        return $stmt->execute([
            'name' => $name,
            'id'   => $id
        ]);
    }

    /** Delete genre */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM genres
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id
        ]);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
        SELECT *
        FROM genres
        WHERE id = :id
        LIMIT 1
    ");

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
