<?php
declare(strict_types=1);
final class AuthService {
    public function __construct(private PDO $db) {}
    public function login(string $email, string $password): ?array {
        $query = $this->db->prepare('SELECT id, name, email, password_hash, role FROM users WHERE email = ? AND active = 1');
        $query->execute([$email]); $user = $query->fetch();
        if (!$user || !password_verify($password, $user['password_hash'])) return null;
        unset($user['password_hash']); return $user;
    }
}
