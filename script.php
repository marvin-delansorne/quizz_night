<?php
require_once 'db_connexion.php';

try {
    // Utiliser l'instance de la classe Database pour obtenir la connexion PDO
    $pdo = $db->getPDO();

    // Lire le contenu du fichier SQL
    $sql = file_get_contents('../sql/create_user_table.sql');

    // Exécuter le script SQL
    $pdo->exec($sql);

    echo "Table 'user' créée avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de la création de la table : " . $e->getMessage();
}
