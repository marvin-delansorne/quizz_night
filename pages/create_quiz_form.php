<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/global.css">
    <title>Créer un Quizz</title>
</head>

<body>
    <?php require_once '../includes/navbar.php'; ?>
    <main>
        <section class="create_quizz">
            <h1>Créer un nouveau quizz</h1>
            <form action="create_quiz.php" method="POST">
                <label for="title">Titre du quizz:</label>
                <input type="text" id="title" name="title" required>

                <div id="questions">
                    <div class="question">
                        <label>Question:</label>
                        <textarea type="text" name="questions[0][text]" id=""></textarea required>
                        <div class="answers">
                            <label>Réponse:</label>
                            <input type="text" name="questions[0][answers][0][text]" required>
                            <label>Correcte:</label>
                            <input type="checkbox" name="questions[0][answers][0][is_correct]">
                        </div>
                        <button type="button" onclick="addAnswer(this)">Ajouter une réponse</button>
                    </div>
                </div>
                <button type="button" onclick="addQuestion()">Ajouter une question</button>
                <button type="submit">Créer</button>
            </form>
            <?php if (!empty($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
        </section>
    </main>
</body>

</html>