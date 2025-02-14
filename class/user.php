<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Trouve un utilisateur par son email
     */
    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Vérifie si le mot de passe correspond à celui enregistré
     */
    public function verifyPassword($user, $password) {
        return password_verify($password, $user['password']);
    }
}
?>