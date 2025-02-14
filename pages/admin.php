<?php
session_start();
require '../class/Database.php';
require '../class/CreateQuizz.php';
require '../class/QuizzForm.php';
require '../class/QuizzHandler.php';

// Connexion à la base de données
$database = new Database();
$pdo = $database->getPDO();

// Instancier la classe QuizHandler
$quizHandler = new QuizHandler($pdo);

// Vérification du formulaire de nombre de questions
$numQuestions = isset($_POST['nb_questions']) ? intval($_POST['nb_questions']) : 0;

// Traitement du formulaire de création de quiz (questions)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titre'], $_POST['questions'])) {
    $titre = htmlspecialchars($_POST['titre']);
    $questions = $_POST['questions'];

    // Créer le quiz
    if ($quizHandler->createQuiz($titre, $questions)) {
        $successMessage = "Quiz créé avec succès !";
    } else {
        $errorMessage = "Erreur lors de la création du quiz.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style-admin.css">
    <link rel="stylesheet" href="../styles/global.css">
    <title>Admin</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <ul class="navbar">
                <li><a><img src="../img/title_navbar.png" alt="title_home"></a></li>
                <div class="navbar_p">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="#">Sign</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <main>
        <section class="achievement">
            <div class="profil_admin">
                <h1><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Invité'; ?></h1>
                <img src="../img/profil_admin.png" alt="profil_img">
                <h1>Mes quizz</h1>
                <img src="../img/gallery_profiladmin.png" alt="gallery_profiladmin">
            </div>
            <div class="badge_all">
                <h1>Badge</h1>
                <ul class="badge">
                    <li><img src="../img/Badge-1.png" alt="badge1"></li>
                    <li><img src="../img/Badge-2.png" alt="badge2"></li>
                    <li><img src="../img/Badge.png" alt="badge3"></li>
                </ul>
            </div>
        </section>
        <section class="create_quizz">
            <h1>Créer votre propre quizz !</h1>

            <?php if (isset($successMessage)) : ?>
                <p style="color: green;"><?php echo $successMessage; ?></p>
            <?php endif; ?>
            <?php if (isset($errorMessage)) : ?>
                <p style="color: red;"><?php echo $errorMessage; ?></p>
            <?php endif; ?>

            <!-- 1ère étape : Choix du nombre de questions -->
            <?php if ($numQuestions == 0) : ?>
                <form method="POST" action="">
                    <div>
                        <label for="nb_questions">Nombre de questions :</label>
                        <input type="number" id="nb_questions" name="nb_questions" min="1" value="3">
                    </div>
                    <input type="submit" value="Valider">
                </form>
            <?php endif; ?>

            <!-- 2ème étape : Formulaire de création du quiz avec questions -->
            <?php if ($numQuestions > 0) : ?>
                <?php
                $quizForm = new QuizForm();
                $quizForm->displayForm($numQuestions);
                ?>
            <?php endif; ?>

        </section>
    </main>
</body>

</html>