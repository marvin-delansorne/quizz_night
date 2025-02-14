<?php
require '../class/Database.php';
require '../class/Answer.php';

// Connexion à la base de données
$database = new Database();
$pdo = $database->getPDO();

// Instancier la classe Answer
$answerManager = new Answer($pdo);

// Récupérer l'ID du quiz depuis le formulaire
$quizId = isset($_POST['quiz_id']) ? (int)$_POST['quiz_id'] : 0;

// Initialiser le score
$score = 0;
$totalQuestions = 0;

// Parcourir les réponses soumises
foreach ($_POST as $key => $value) {
    if (strpos($key, 'question_') === 0) {
        $questionId = (int)str_replace('question_', '', $key);
        $answerId = (int)$value;

        // Vérifier si la réponse est correcte
        $answer = $answerManager->getAnswerById($answerId);
        if ($answer && $answer['est_correcte']) {
            $score++;
        }

        $totalQuestions++;
    }
}

// Calculer le pourcentage de bonnes réponses
$percentage = ($totalQuestions > 0) ? round(($score / $totalQuestions) * 100) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style-result.css">
    <link rel="stylesheet" href="../styles/global.css">
    <title>Résultats du Quiz</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <ul class="navbar">
                <li>
                    <a href="../index.php"><img src="../img/title_navbar.png" alt="title_home"></a>
                </li>
                <div class="navbar_p">
                    <li>
                        <a href="../index.php">Home</a>
                    </li>
                    <li>
                        <a href="./login.php">Login</a>
                    </li>
                </div>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Résultats du Quiz</h1>
        <div class="result-container">
            <p>Vous avez répondu correctement à <strong><?php echo $score; ?></strong> questions sur <strong><?php echo $totalQuestions; ?></strong>.</p>
            <p>Votre score est de <strong><?php echo $percentage; ?>%</strong>.</p>
        </div>
        <a href="../index.php" class="btn-retour">Retour à l'accueil</a>
    </main>
</body>

</html>