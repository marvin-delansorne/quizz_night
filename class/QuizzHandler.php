<?php

class QuizHandler {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour créer le quiz dans la base de données
    public function createQuiz($titre, $questions) {
        // Insérer le titre du quiz dans la base de données
        $stmt = $this->pdo->prepare("INSERT INTO quizzes (titre) VALUES (:titre)");
        $stmt->execute([':titre' => $titre]);
        $quizId = $this->pdo->lastInsertId();

        // Ajouter les questions et réponses
        foreach ($questions as $index => $questionData) {
            $question = $questionData['texte'];

            // Insérer la question
            $stmt = $this->pdo->prepare("INSERT INTO questions (quiz_id, question) VALUES (:quiz_id, :question)");
            $stmt->execute([':quiz_id' => $quizId, ':question' => $question]);
            $questionId = $this->pdo->lastInsertId();

            // Ajouter les réponses
            foreach ($questionData['reponses'] as $reponseData) {
                $reponse = $reponseData['texte'];
                $estCorrecte = isset($reponseData['est_correcte']) ? 1 : 0;

                // Insérer la réponse
                $stmt = $this->pdo->prepare("INSERT INTO reponses (question_id, reponse, est_correcte) VALUES (:question_id, :reponse, :est_correcte)");
                $stmt->execute([':question_id' => $questionId, ':reponse' => $reponse, ':est_correcte' => $estCorrecte]);
            }
        }

        return true;
    }
}
