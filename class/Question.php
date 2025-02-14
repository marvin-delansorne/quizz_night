<?php
// classes/Question.php
class Question
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer les questions d'un quiz
    public function getQuestionsByQuizId($quizId)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM question WHERE quiz_id = ?');
        $stmt->execute([$quizId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
