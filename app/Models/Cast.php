<?php

class Cast
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all(): array
    {
        return $this->db->query("
            SELECT *
            FROM `cast`
            ORDER BY name ASC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO `cast` (name, profile_image_url, bio, date_of_birth)
            VALUES (:name, :img, :bio, :dob)
        ");

        return $stmt->execute([
            'name' => $data['name'],
            'img'  => $data['profile_image_url'],
            'bio'  => $data['bio'],
            'dob'  => $data['date_of_birth']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE `cast`
            SET name = :name,
                profile_image_url = :img,
                bio = :bio,
                date_of_birth = :dob
            WHERE id = :id
        ");

        return $stmt->execute([
            'id'   => $id,
            'name' => $data['name'],
            'img'  => $data['profile_image_url'],
            'bio'  => $data['bio'],
            'dob'  => $data['date_of_birth']
        ]);
    }

    public function delete(int $id): bool
    {
        return $this->db
            ->prepare("DELETE FROM `cast` WHERE id = :id")
            ->execute(['id' => $id]);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM cast
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
