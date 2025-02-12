<?php
require_once '../class/Database.php';
require_once '../class/User.php';
require_once '../class/Auth.php';

// Initialisation des variables
$error = '';

// Vérifie si le formulaire de connexion est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Validation des champs
    if (empty($email) || empty($password)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        try {
            // Connexion à la base de données
            $database = new Database();
            $userModel = new User($database->getConnection());

            // Recherche de l'utilisateur par email
            $user = $userModel->findByEmail($email);

            // Vérification du mot de passe
            if ($user && $userModel->verifyPassword($user, $password)) {
                // Création des cookies et redirection
                Auth::setCookies($user);
                Auth::redirect('../pages/profile.php');
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            $error = "Erreur de base de données : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../styles/global.css">
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
                        <a href="#">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            Login
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Sign
                        </a>
                    </li>
                </div>
            </ul>
        </nav>
    </header>
    <h1>Connexion</h1>
    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="email">Email de l'utilisateur</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Mot de passe de l'utilisateur</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>