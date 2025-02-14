<?php
require_once '../class/Database.php';
class Answer
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createAnswer($questionId, $text, $isCorrect)
    {
        $stmt = $this->pdo->prepare("INSERT INTO answers (question_id, text, is_correct, created_at) VALUES (?, ?, ?, NOW())");
        return $stmt->execute([$questionId, $text, $isCorrect]);
    }

    public function getAnswersByQuestion($questionId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM answers WHERE question_id = ?");
        $stmt->execute([$questionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
