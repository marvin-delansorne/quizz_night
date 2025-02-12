<?php
class Auth {
    /**
     * Crée des cookies pour l'utilisateur connecté
     */
    public static function setCookies($user) {
        setcookie('user_id', $user['id'], time() + (3600 * 30), "/"); // Cookie valide 30 jours
        setcookie('username', $user['username'], time() + (3600 * 30), "/");
    }

    /**
     * Redirige l'utilisateur vers une page spécifique
     */
    public static function redirect($url) {
        header("Location: ../pages/admin.php");
        exit();
    }
}
?>