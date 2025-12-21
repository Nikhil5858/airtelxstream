<?php
class OttProvider
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function allActive(): array
    {
        return $this->db->query("
            SELECT * FROM ott_providers
            WHERE is_active = 1
            ORDER BY name ASC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
        SELECT id, name, logo_url
        FROM ott_providers
        WHERE id = :id
          AND is_active = 1
        LIMIT 1
    ");

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
