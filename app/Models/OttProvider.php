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
}
