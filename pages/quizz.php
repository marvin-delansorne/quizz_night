<?php
require '../class/Database.php';
require '../class/Quiz.php';
require '../class/Question.php';
require '../class/Answer.php';

// Connexion à la base de données
$database = new Database();
$pdo = $database->getPDO();

// Récupérer l'ID du quiz depuis l'URL
$quizId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Instancier les classes
$quizManager = new Quiz($pdo);
$questionManager = new Question($pdo);
$answerManager = new Answer($pdo);

// Récupérer le quiz
$quiz = $quizManager->getQuizById($quizId);

// Vérifier si le quiz existe
if (!$quiz) {
    die("Quiz non trouvé.");
}

// Récupérer les questions du quiz
$questions = $questionManager->getQuestionsByQuizId($quizId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style-quiz.css">
    <link rel="stylesheet" href="../styles/global.css">
    <title><?php echo htmlspecialchars($quiz['titre']); ?></title>
</head>

<body>
    <?php require_once '../includes/navbar.php'; ?>
    <main>
        <h1><?php echo htmlspecialchars($quiz['titre']); ?></h1>
        <form method="POST" action="./result.php">
            <?php foreach ($questions as $question) : ?>
                <div class="question">
                    <h2><?php echo htmlspecialchars($question['texte']); ?></h2>
                    <?php
                    // Récupérer les réponses de la question
                    $answers = $answerManager->getAnswersByQuestionId($question['id']);
                    ?>
                    <?php foreach ($answers as $answer) : ?>
                        <div class="answer">
                            <input type="radio" name="question_<?php echo $question['id']; ?>" value="<?php echo $answer['id']; ?>" required>
                            <label><?php echo htmlspecialchars($answer['texte']); ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <input type="hidden" name="quiz_id" value="<?php echo $quizId; ?>">
            <input type="submit" value="Soumettre le quiz">
        </form>
    </main>
</body>

</html>