<?php
include '../class/user.php';

class Register
{
    private $user;

    public function __construct($name, $username, $email, $password, $confirm_password)
    {
        $this->user = new User($name, $username, $email, $password, $confirm_password);
    }

    // Traitement de l'inscription
    public function processRegistration()
    {
        if ($this->user->validateUsername() && $this->user->validateEmail() && $this->user->validatePassword() && $this->user->validateConfirmPassword()) {
            // Logique pour enregistrer l'utilisateur dans la base de données
            // Si la connexion réussie, vous pourriez rediriger l'utilisateur ou afficher un message
            return "Inscription réussie !";
        } else {
            return "Il y a des erreurs dans le formulaire.";
        }
    }
} ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ça Quizz ou Quoi ?</title>
    <link rel="stylesheet" href="../styles/auth.css">
</head>

<body>
    <nav class="navbar">
        <section class="logo">
            <span class="site-title">ÇA QUIZZ OU QUOI ?</span>
        </section>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="pages/register.php">Inscription</a></li>
            <li><a href="pages/login.php">Connexion</a></li>
        </ul>
    </nav>
    <section class="auth-container">
        <form action="register.php" method="POST" class="auth-form">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="confirm_password">Confirmer le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br><br>

            <button type="submit">S'inscrire</button>
        </form>

        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <a href="./login.php"><span class="connexion">Déjà inscrit? Cliquez ici !</span></a>
    </section>