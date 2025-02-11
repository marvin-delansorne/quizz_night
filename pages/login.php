<?php
include '../class/user.php';

class Login
{
    private $username;
    private $password;
    private $db;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

        // Instancier la classe Database
        global $host, $dbname, $username, $password;
        $this->db = new Database($host, $dbname, $username, $password);
    }

    // Traitement de la connexion
    public function processLogin()
    {
        $pdo = $this->db->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM user WHERE username = ?');
        $stmt->execute([$this->username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['password'])) {
            // Connexion réussie
            return "Connexion réussie !";
        } else {
            // Échec de la connexion
            return "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Instancier la classe Login avec les données envoyées via le formulaire
    $login = new Login($_POST['username'], $_POST['password']);
    $message = $login->processLogin();
}
?>

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
            <li><a href="login.php">Connexion</a></li>
        </ul>
    </nav>
    <section class="auth-container">
        <form action="login.php" method="POST" class="auth-form">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Se connecter</button>
        </form>

        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <a href="pages/register.php"><span class="connexion">Pas encore inscrit? Cliquez ici !</span></a>
    </section>
</body>