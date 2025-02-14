<?php

// classes/Database.php
class Database
{
    private $pdo;

    public function __construct()
    {
        // Connexion à la base de données
        $dsn = 'mysql:host=localhost;dbname=quizz_night;charset=utf8';
        $username = 'root'; // Remplace par ton nom d'utilisateur MySQL
        $password = 'root'; // Remplace par ton mot de passe MySQL

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Retourne l'objet PDO
    public function getPDO()
    {
        return $this->pdo;
    }
}
