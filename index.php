<?php
require './class/Database.php';
require './class/Quiz.php';

// Connexion à la base de données
$database = new Database();
$pdo = $database->getPDO();

// Instancier la classe Quiz
$quizManager = new Quiz($pdo);

// Récupérer tous les quiz depuis la base de données
$quizzes = $quizManager->getAllQuizzes();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style-home.css">
    <link rel="stylesheet" href="./styles/global.css">
    <title>Quizz Night</title>
</head>


<body>
    <?php require_once 'includes/navbar.php'; ?>
    <main>
        <img class="women_img" src="./img/img_p_home.png" alt="img_home">
        <section class="container_p1">

            <h1>
                Propose nous tes question !
            </h1>

            <p>
                Soumets tes idées de questions à l'équipe Quiz Room et son comité de rédaction de questions. Si les
                questions nous intéressent, nous y appliquerons la patte Quiz Room et les intègrerons à notre base de
                questions ! Nous remercions les contributeurs en offrant des places gratuites lorsque nous retenons les
                questions proposées. C'est le moment pour toi de briller et de crâner un max, la prochaine fois que tu
                viendras jouer avec ta team !

                On t'entends d'ici : "C'est moi qui l'ai inventée, celle-là !"
            </p>
        </section>
        <section class="container_p2">
            <img class="popular_quizz" src="./img/pupular_quizz.png" alt="popular_quizz">

            <!-- Section des quiz disponibles -->
            <h2>Quiz disponibles</h2>

            <?php if (empty($quizzes)) : ?>
                <p><span>Aucun quiz disponible pour le moment.<span></p>
            <?php else : ?>

                <?php foreach ($quizzes as $quiz) : ?>
                    <ul class="choiceQuizz">
                        <li>
                            <a class="choiceQuizz" href="./pages/quizz.php?id=<?php echo $quiz['id']; ?>">
                                <?php echo htmlspecialchars($quiz['titre']); ?>
                            </a>
                        </li>
                    </ul>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

    </main>
    <footer>
    </footer>
</body>

</html>