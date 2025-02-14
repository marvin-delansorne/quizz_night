<?php
require_once '../class/Database.php';
class Quiz
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createQuiz($title)
    {
        $stmt = $this->pdo->prepare("INSERT INTO quizzes (title, created_at) VALUES (?, NOW())");
        return $stmt->execute([$title]);
    }

    public function getQuiz($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM quizzes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllQuizzes()
    {
        $stmt = $this->pdo->query("SELECT * FROM quizzes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
