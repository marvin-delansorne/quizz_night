<?php
require_once '../includes/db_connexion.php';

class User
{
    private $nom;
    private $username;
    private $email;
    private $password;
    private $confirm_password;

    // Constructeur
    public function __construct($nom, $username, $email, $password, $confirm_password)
    {
        $this->nom = $nom;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
    }

    // Validation du nom d'utilisateur
    public function validateUsername()
    {
        return !empty($this->username) && strlen($this->username) >= 3;
    }

    // Validation de l'email
    public function validateEmail()
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    // Validation du mot de passe
    public function validatePassword()
    {
        return !empty($this->password) && strlen($this->password) >= 6;
    }

    // Vérification que les mots de passe correspondent
    public function validateConfirmPassword()
    {
        return $this->password === $this->confirm_password;
    }

    // Récupérer l'utilisateur sous forme de tableau pour affichage
    public function getUserData()
    {
        return [
            'nom' => $this->nom,
            'username' => $this->username,
            'email' => $this->email,
        ];
    }

    // Insérer un nouvel utilisateur dans la base de données
    public function save()
    {
        global $db; // Assurez-vous que $db est accessible ici
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare('INSERT INTO user (nom, username, email, password) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$this->nom, $this->username, $this->email, password_hash($this->password, PASSWORD_DEFAULT)]);
    }
}
