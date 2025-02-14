<?php
session_start();
require '../class/Database.php';
require '../class/CreateQuizz.php';

// Connexion à la base de données
$database = new Database();
$pdo = $database->getPDO();

// Instancier la classe CreateQuizz
$createQuizz = new CreateQuizz($pdo);

// Traitement du formulaire de création de quiz
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = htmlspecialchars($_POST['titre']);
    $questions = $_POST['questions'];

    // Créer le quiz
    if ($createQuizz->createFullQuiz($titre, $questions)) {
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
                <li>
                    <a><img src="../img/title_navbar.png" alt="title_home"></a>
                </li>
                <div class="navbar_p">
                    <li>
                        <a href="../index.php">Home</a>
                    </li>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                    <li>
                        <a href="#">Sign</a>
                    </li>
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
            <form method="POST" action="">
                <div>
                    <label for="titre">Titre du quiz :</label>
                    <input type="text" id="titre" name="titre" required>
                </div>

                <!-- Questions et réponses -->
                <?php for ($i = 0; $i < 3; $i++) : ?>
                    <div class="question">
                        <label>Question <?php echo $i + 1; ?> :</label>
                        <input type="text" name="questions[<?php echo $i; ?>][texte]" required>
                        <?php for ($j = 0; $j < 3; $j++) : ?>
                            <div>
                                <label>Réponse <?php echo $j + 1; ?> :</label>
                                <input type="text" name="questions[<?php echo $i; ?>][reponses][<?php echo $j; ?>][texte]" required>
                                <input type="checkbox" name="questions[<?php echo $i; ?>][reponses][<?php echo $j; ?>][est_correcte]"> Correcte
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>

                <input type="submit" value="Créer le quiz">
            </form>
        </section>
    </main>
</body>
</html>