<?php
class User
{
    private $pdo;

    public function __construct($host, $dbname, $username, $password)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function loginOrRegister($username)
    {
        // Vérifie si l'utilisateur existe déjà
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // L'utilisateur existe, connexion réussie
            return true;
        } else {
            // L'utilisateur n'existe pas, l'enregistrer avec un mot de passe par défaut
            $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $defaultPassword = password_hash('default_password', PASSWORD_DEFAULT); // Mot de passe par défaut
            return $stmt->execute([$username, $defaultPassword]);
        }
    }
}
