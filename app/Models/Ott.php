<?php

class Ott
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /** Fetch all OTT providers */
    public function all(): array
    {
        $stmt = $this->db->query("
            SELECT id, name, logo_url, is_active
            FROM ott_providers
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Create OTT */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO ott_providers (name, logo_url, is_active)
            VALUES (:name, :logo_url, :is_active)
        ");

        return $stmt->execute([
            'name'      => $data['name'],
            'logo_url'  => $data['logo_url'],
            'is_active' => $data['is_active']
        ]);
    }

    /** Update OTT */
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE ott_providers SET
                name = :name,
                logo_url = :logo_url,
                is_active = :is_active
            WHERE id = :id
        ");

        return $stmt->execute([
            'id'        => $id,
            'name'      => $data['name'],
            'logo_url'  => $data['logo_url'],
            'is_active' => $data['is_active']
        ]);
    }

    /** Delete OTT */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM ott_providers WHERE id = :id
        ");

        return $stmt->execute(['id' => $id]);
    }
}
