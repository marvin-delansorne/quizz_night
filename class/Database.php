<?php
class Database {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhostt;dbname=quizz_night', 'root', 'root');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>