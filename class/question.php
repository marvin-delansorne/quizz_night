<?php
require_once '../class/Database.php';
class Question
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createQuestion($quizId, $text)
    {
        $stmt = $this->pdo->prepare("INSERT INTO questions (quiz_id, text, created_at) VALUES (?, ?, NOW())");
        return $stmt->execute([$quizId, $text]);
    }

    public function getQuestionsByQuiz($quizId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM questions WHERE quiz_id = ?");
        $stmt->execute([$quizId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
