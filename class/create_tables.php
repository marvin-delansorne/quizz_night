<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../class/Database.php'; // Corriger le chemin d'inclusion

// Informations de connexion à la base de données
$host = 'localhost';
$dbname = 'quizz_night';
$username = 'root';
$password = 'root';

// Initialiser la connexion à la base de données via la classe Database
$database = new Database($host, $dbname, $username, $password);
$pdo = $database->getPDO(); // Récupérer l'objet PDO

// Fonction pour créer une table
function createTable($pdo, $tableName, $columns)
{
    try {
        $columnsSql = implode(", ", $columns); // Convertir le tableau en chaîne SQL
        $sql = "CREATE TABLE IF NOT EXISTS {$tableName} ({$columnsSql})";
        $pdo->exec($sql); // Exécuter la requête
        echo "Table '{$tableName}' créée avec succès.<br>";
    } catch (PDOException $e) {
        echo "Erreur lors de la création de la table '{$tableName}' : " . $e->getMessage() . "<br>";
    }
}

// Définir les tables et leurs colonnes
$tables = [
    'quizz' => [
        'id INT AUTO_INCREMENT PRIMARY KEY',
        'theme VARCHAR(255) NOT NULL',
        'date_creation DATE'
    ],
    'questions' => [
        'id INT AUTO_INCREMENT PRIMARY KEY',
        'quizz_id INT NOT NULL',
        'question TEXT NOT NULL',
        'correct_answer TEXT NOT NULL',
        'FOREIGN KEY (quizz_id) REFERENCES quizz(id) ON DELETE CASCADE'
    ],
    'wrong_answers' => [
        'id INT AUTO_INCREMENT PRIMARY KEY',
        'question_id INT NOT NULL',
        'wrong_answer TEXT NOT NULL',
        'FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE'
    ]
];

// Créer les tables dynamiquement
foreach ($tables as $tableName => $columns) {
    createTable($pdo, $tableName, $columns);
}
