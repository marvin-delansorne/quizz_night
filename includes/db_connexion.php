<?php
// Informations de connexion
$host = 'localhost';
$dbname = 'quizz_night'; // Nom de la base
$username = 'root'; // Par défaut pour phpMyAdmin
$password = 'root';

class Database
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    public function __construct($host, $dbname, $username, $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;

        try {
            // Créer une connexion avec la base "mysql" pour la création de la base
            $this->pdo = new PDO("mysql:host={$this->host}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Vérifier si la base existe, sinon la créer
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS {$this->dbname}");
            echo "Base de données créée ou déjà existante.<br>";

            // Se connecter à la base nouvellement créée
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo 'Connexion réussie à la base de données!<br>';
        } catch (PDOException $e) {
            echo 'Une erreur est survenue : ' . $e->getMessage();
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}

// Utilisation de la classe Database
$db = new Database($host, $dbname, $username, $password);
