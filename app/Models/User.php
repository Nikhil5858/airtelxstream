<?php

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("
            SELECT * 
            FROM users 
            WHERE email = :email 
            LIMIT 1
        ");

        $stmt->execute([
            'email' => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    /**
     * Verify login credentials
     */
    public function verifyLogin(string $email, string $password): bool
    {
        $user = $this->findByEmail($email);

        if (!$user) {
            return false;
        }

        if ($password !== $user['password']) {
            return false;
        }

        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_email'] = $user['email'];

        return true;
    }

    public function all(): array
    {
        return $this->db->query("
            SELECT 
                id, name, email,
                is_subscription_active,
                created_at,
                last_login
            FROM users
            ORDER BY id DESC
        ")->fetchAll();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO users
            (name, email, password, is_subscription_active)
            VALUES
            (:name, :email, :password, :is_subscription_active)
        ");

        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;

        return $this->db->prepare("
            UPDATE users SET
                name=:name,
                is_subscription_active=:is_subscription_active
            WHERE id=:id
        ")->execute($data);
    }

    public function delete(int $id): bool
    {
        return $this->db
            ->prepare("DELETE FROM users WHERE id=?")
            ->execute([$id]);
    }
}
