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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Instancier la classe Register avec les données envoyées via le formulaire
    $register = new Register($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
    $message = $register->processRegistration();
}
?>

<section class="container_card">
    <form action="register.php" method="POST">
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