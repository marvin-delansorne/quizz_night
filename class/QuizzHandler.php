<?php

class QuizHandler {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour créer le quiz dans la base de données
    public function createQuiz($titre, $question) {
        // Insérer le titre du quiz dans la base de données
        $stmt = $this->pdo->prepare("INSERT INTO quizzes (titre) VALUES (:titre)");
        $stmt->execute([':titre' => $titre]);
        $quizId = $this->pdo->lastInsertId();

        // Ajouter les questions et réponses
        foreach ($question as $index => $questionData) {
            $question = $questionData['texte'];

            // Insérer la question
            $stmt = $this->pdo->prepare("INSERT INTO question (quiz_id, texte) VALUES (:quiz_id, :texte)");
            $stmt->execute([':quiz_id' => $quizId, ':texte' => $question]);
            $questionId = $this->pdo->lastInsertId();

            // Ajouter les réponses
            foreach ($questionData['reponses'] as $reponseData) {
                $reponse = $reponseData['texte'];
                $estCorrecte = isset($reponseData['est_correcte']) ? 1 : 0;

                // Insérer la réponse
                $stmt = $this->pdo->prepare("INSERT INTO reponses (question_id, texte, est_correcte) VALUES (:question_id, :texte, :est_correcte)");
                $stmt->execute([':question_id' => $questionId, ':texte' => $reponse, ':est_correcte' => $estCorrecte]);
            }
        }

        return true;
    }
}
