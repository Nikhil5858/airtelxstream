<?php

class CastRole
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all(): array
    {
        return $this->db->query("
            SELECT id, role_name
            FROM cast_roles
            ORDER BY role_name ASC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $name): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO cast_roles (role_name)
            VALUES (:name)
        ");

        return $stmt->execute(['name' => $name]);
    }

    public function update(int $id, string $name): bool
    {
        $stmt = $this->db->prepare("
            UPDATE cast_roles
            SET role_name = :name
            WHERE id = :id
        ");

        return $stmt->execute([
            'id'   => $id,
            'name' => $name
        ]);
    }

    public function delete(int $id): bool
    {
        // Prevent delete if role is used
        $used = $this->db->prepare("
            SELECT COUNT(*) FROM cast_content WHERE cast_roles_id = :id
        ");
        $used->execute(['id' => $id]);

        if ($used->fetchColumn() > 0) {
            return false;
        }

        $stmt = $this->db->prepare("
            DELETE FROM cast_roles WHERE id = :id
        ");

        return $stmt->execute(['id' => $id]);
    }
}
