<?php
// classes/Quiz.php
class Quiz {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer tous les quiz
    public function getAllQuizzes() {
        $stmt = $this->pdo->query('SELECT * FROM quizzes');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un quiz par son ID
    public function getQuizById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM quizzes WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>