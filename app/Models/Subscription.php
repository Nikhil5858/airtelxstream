<?php

class Subscription
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
            FROM subscription
            ORDER BY price ASC
        ")->fetchAll();
    }

    public function create(array $data): bool
    {
        return $this->db->prepare("
            INSERT INTO subscription
            (plan_name, price, duration_days, is_active, created_at)
            VALUES
            (:plan_name, :price, :duration_days, :is_active, NOW())
        ")->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;

        return $this->db->prepare("
            UPDATE subscription SET
                plan_name=:plan_name,
                price=:price,
                duration_days=:duration_days,
                is_active=:is_active
            WHERE id=:id
        ")->execute($data);
    }

    public function delete(int $id): bool
    {
        return $this->db
            ->prepare("DELETE FROM subscription WHERE id=?")
            ->execute([$id]);
    }
}
