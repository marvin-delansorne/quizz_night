<?php
session_start();
require_once '../includes/db_connexion.php';
require_once '../class/Quiz.php';
require_once '../class/Question.php';
require_once '../class/Answer.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $questions = $_SESSION['questions'];

    if (!empty($title) && !empty($questions)) {
        $quiz = new Quiz($pdo);
        if ($quiz->createQuiz($title)) {
            $quizId = $pdo->lastInsertId();
            $questionObj = new Question($pdo);
            $answerObj = new Answer($pdo);

            foreach ($questions as $question) {
                $questionText = trim($question['text']);
                if (!empty($questionText)) {
                    $questionObj->createQuestion($quizId, $questionText);
                    $questionId = $pdo->lastInsertId();

                    foreach ($question['answers'] as $answer) {
                        $answerText = trim($answer['text']);
                        $isCorrect = isset($answer['is_correct']) ? 1 : 0;
                        if (!empty($answerText)) {
                            $answerObj->createAnswer($questionId, $answerText, $isCorrect);
                        }
                    }
                }
            }
            $message = "Quizz créé avec succès !";
            unset($_SESSION['questions']);
        } else {
            $message = "Erreur lors de la création du quizz.";
        }
    } else {
        $message = "Veuillez entrer un titre et au moins une question.";
    }
}

header("Location: ../pages/create_quiz.php?message=" . urlencode($message));
exit();
