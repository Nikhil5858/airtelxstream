<?php

class Myplan
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getActivePlans(): array
    {
        $stmt = $this->db->query("
            SELECT id, plan_name, price, duration_days
            FROM subscription
            WHERE is_active = 1
            ORDER BY price ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
