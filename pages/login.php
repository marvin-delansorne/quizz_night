<?php
require_once '../class/user.php';

$message = '';

// Vérifie les données envoyées via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = trim($_POST['pseudo']);

    if (!empty($pseudo)) {
        // Instancie la classe User
        $user = new User($host, $dbname, $username, $password);
        if ($user->loginOrRegister($pseudo)) {
            $message = "Connexion réussie ! Bienvenue, $pseudo.";
        } else {
            $message = "Erreur lors de la connexion.";
        }
    } else {
        $message = "Veuillez entrer un pseudo.";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ça Quizz ou Quoi ?</title>
    <link rel="stylesheet" href="../styles/auth.css">
</head>

<body>
    <?php require_once '../includes/navbar.php'; ?>

    <section class="auth-container">
        <form action="login.php" method="POST" class="auth-form">
            <label for="pseudo">Entrer votre pseudo</label>
            <input type="text" id="pseudo" name="pseudo" placeholder="Entrer votre pseudo" required>
            <button type="submit">Enregistrer</button>
        </form>
        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
    </section>
</body>