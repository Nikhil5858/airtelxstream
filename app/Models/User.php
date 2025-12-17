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

    public function saveOtp(int $userId, string $otp, string $expires): void
    {
        $this->db->prepare("
            UPDATE user_otp SET is_used = 1 WHERE user_id = ?
        ")->execute([$userId]);

        $stmt = $this->db->prepare("
            INSERT INTO user_otp (user_id, otp, expires_at)
            VALUES (:uid, :otp, :exp)
        ");

        $stmt->execute([
            'uid' => $userId,
            'otp' => $otp,
            'exp' => $expires
        ]);
    }

    public function verifyOtp(int $userId, string $otp): bool
    {
        $stmt = $this->db->prepare("
            SELECT id 
            FROM user_otp
            WHERE user_id = :uid
            AND otp = :otp
            AND is_used = 0
            AND expires_at >= NOW()
            ORDER BY id DESC
            LIMIT 1
        ");

        $stmt->execute([
            'uid' => $userId,
            'otp' => $otp
        ]);

        $row = $stmt->fetch();

        if (!$row) return false;

        $this->db->prepare("
            UPDATE user_otp SET is_used = 1 WHERE id = ?
        ")->execute([$row['id']]);

        return true;
    }

    public function findOrCreateByEmail(string $email, string $name): array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // update name if empty
            if (!$user['name'] && $name) {
                $this->db->prepare(
                    "UPDATE users SET name = ? WHERE id = ?"
                )->execute([$name, $user['id']]);
            }
            return $user;
        }

        // create new user
        $this->db->prepare("
            INSERT INTO users (email, name, is_active)
            VALUES (?, ?, 1)
        ")->execute([$email, $name]);

        return [
            'id' => $this->db->lastInsertId(),
            'email' => $email,
            'name' => $name
        ];
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT id, email, name
            FROM users
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

}
