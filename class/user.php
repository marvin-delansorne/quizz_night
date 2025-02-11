<?php
require_once '../includes/db_connexion.php';

class User
{
    private $username;
    private $email;
    private $password;
    private $confirm_password;

    // Constructeur
    public function __construct($username, $email, $password, $confirm_password)
    {
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
            'username' => $this->username,
            'email' => $this->email,
        ];
    }
}
