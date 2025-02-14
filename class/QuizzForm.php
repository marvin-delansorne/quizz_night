<?php
class QuizForm {
    // Méthode pour afficher le formulaire de création de quiz
    public function displayForm($numQuestions = 3) {
        ?>
        <form method="POST" action="">
            <div>
                <label for="titre">Titre du quiz :</label>
                <input type="text" id="titre" name="titre" required>
            </div>

            <!-- Conteneur pour les questions -->
            <div id="questions_container">
                <?php
                // Afficher dynamiquement les questions en fonction du nombre
                for ($i = 0; $i < $numQuestions; $i++) {
                    $this->displayQuestion($i);
                }
                ?>
            </div>

            <input type="submit" value="Créer le quiz">
        </form>
        <?php
    }

    // Méthode pour afficher une question avec ses réponses
    private function displayQuestion($index) {
        ?>
        <div class="question">
            <label>Question <?php echo $index + 1; ?> :</label>
            <input type="text" name="questions[<?php echo $index; ?>][texte]" required>
            <?php $this->displayReponses($index); ?>
        </div>
        <?php
    }

    // Méthode pour afficher les réponses d'une question
    private function displayReponses($index) {
        for ($i = 0; $i < 3; $i++) {
            ?>
            <div>
                <label>Réponse <?php echo $i + 1; ?> :</label>
                <input type="text" name="questions[<?php echo $index; ?>][reponses][<?php echo $i; ?>][texte]" required>
                <input type="checkbox" name="questions[<?php echo $index; ?>][reponses][<?php echo $i; ?>][est_correcte]"> Correcte
            </div>
            <?php
        }
    }
}
