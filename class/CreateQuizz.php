<?php
// classes/CreateQuizz.php
class CreateQuizz {
    private $pdo;

    // Constructeur : initialise la connexion à la base de données
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crée un nouveau quiz
    public function createQuiz($titre) {
        $stmt = $this->pdo->prepare('INSERT INTO quizzes (titre) VALUES (?)');
        $stmt->execute([$titre]);
        return $this->pdo->lastInsertId(); // Retourne l'ID du quiz créé
    }

    // Crée une nouvelle question
    public function createQuestion($quizId, $texte) {
        $stmt = $this->pdo->prepare('INSERT INTO questions (quiz_id, texte) VALUES (?, ?)');
        $stmt->execute([$quizId, $texte]);
        return $this->pdo->lastInsertId(); // Retourne l'ID de la question créée
    }

    // Crée une nouvelle réponse
    public function createAnswer($questionId, $texte, $estCorrecte) {
        $stmt = $this->pdo->prepare('INSERT INTO reponses (question_id, texte, est_correcte) VALUES (?, ?, ?)');
        $stmt->execute([$questionId, $texte, $estCorrecte]);
    }

    // Crée un quiz complet avec ses questions et réponses
    public function createFullQuiz($titre, $questions) {
        try {
            // Commencer une transaction
            $this->pdo->beginTransaction();

            // Créer le quiz
            $quizId = $this->createQuiz($titre);

            // Créer les questions et réponses
            foreach ($questions as $question) {
                $questionId = $this->createQuestion($quizId, $question['texte']);
                foreach ($question['reponses'] as $reponse) {
                    // Vérifier si la clé "est_correcte" existe, sinon la définir à 0 (faux)
                    $estCorrecte = isset($reponse['est_correcte']) ? 1 : 0;
                    $this->createAnswer($questionId, $reponse['texte'], $estCorrecte);
                }
            }

            // Valider la transaction
            $this->pdo->commit();
            return true; // Succès
        } catch (PDOException $e) {
            // Annuler la transaction en cas d'erreur
            $this->pdo->rollBack();
            return false; // Échec
        }
    }
}
?>