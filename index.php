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
    <header>
        <nav class="navbar">
            <ul class="navbar">
                <li>
                    <a href="index.php"><img src="./img/title_navbar.png" alt="title_home"></a>
                </li>
                <div class="navbar_p">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="./pages/login.php">Login</a>
                    </li>
                </div>
            </ul>
        </nav>
    </header>

    <main>
        <img class="women_img" src="./img/img_p_home.png" alt="img_home">
        <section class="container_p1">
            <h1>Propose nous tes questions !</h1>
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
            
            <!-- Section des images statiques -->
            <ul class="children_img">
                <li>
                    <a href="#">
                        <img src="./img/gallery_img1.png" alt="gallery_img1">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="./img/gallery_img2.png" alt="gallery_img2">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="./img/gallery_img3.png" alt="gallery_img3">
                    </a>
                </li>
            </ul>
            <ul class="children_img">
                <li>
                    <a href="#">
                        <img src="./img/gallery_img4.png" alt="gallery_img4">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="./img/gallery_img5.png" alt="gallery_img5">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="./img/gallery_img6.png" alt="gallery_img6">
                    </a>
                </li>
            </ul>

            <!-- Section des quiz disponibles -->
            <h2>Quiz disponibles</h2>
            <?php if (empty($quizzes)) : ?>
                <p>Aucun quiz disponible pour le moment.</p>
            <?php else : ?>
                <ul class="quiz-list">
                    <?php foreach ($quizzes as $quiz) : ?>
                        <li>
                            <a href="./pages/quizz.php?id=<?php echo $quiz['id']; ?>">
                                <?php echo htmlspecialchars($quiz['titre']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    </main>
    <footer>
    </footer>
</body>

</html>