<?php
// classes/Answer.php
class Answer {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer une réponse par son ID
    public function getAnswerById($answerId) {
        $stmt = $this->pdo->prepare('SELECT * FROM reponses WHERE id = ?');
        $stmt->execute([$answerId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer les réponses d'une question
    public function getAnswersByQuestionId($questionId) {
        $stmt = $this->pdo->prepare('SELECT * FROM reponses WHERE question_id = ?');
        $stmt->execute([$questionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>