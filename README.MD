# Projet : Site de Création de Quiz

## Description

Ce projet permet aux utilisateurs de créer et gérer des quiz sans être connectés, tout en offrant aux administrateurs la possibilité de gérer tous les quiz via un tableau de bord. Les utilisateurs peuvent voir les quiz créés, mais uniquement les administrateurs peuvent ajouter, modifier ou supprimer des questions et réponses.

### Fonctionnalités principales :
- **Page d'accueil** : Affichage de tous les quiz créés.
- **Création de quiz** : Les utilisateurs ne peuvent pas créer de quiz, mais peuvent consulter ceux qui ont été créés.
- **Gestion des questions et réponses** : Les utilisateurs peuvent ajouter, modifier et supprimer les questions et les réponses d'un quiz existant.
- **Page Admin** : Tableau de bord permettant aux administrateurs de créer, modifier et supprimer des quiz et des questions.
- **Connexion** : Module de connexion permettant aux administrateurs d’accéder à la partie administration.
- **Resultat** : Module qui permet d'avoir le score du quizz avec les bonnes réponses.

---

## Structure des Pages
- **index.php** : Page d'accueil affichant tous les quiz créés.
- **admin.php** : Tableau de bord des administrateurs permettant de gérer les quiz.
- **connexion.php** : Formulaire de connexion pour les administrateurs.
- **quiz.php** : Affichage des questions et réponses pour un quiz spécifique.
- **creer_quiz.php** : Formulaire permettant aux administrateurs de créer un nouveau quiz avec ses questions et réponses.
- **modifier_quiz.php** : Permet aux administrateurs de modifier les questions et réponses d’un quiz existant.
-**resultat.php** : Permet aux utilisateurs d'accéder à leur scores automatiquement après validation du quizz.

---

## Base de données
### Tables :
- **users** : `id`, `login`, `password`, `role`, `created_at`.
- **quizzes** : `id`, `title`, `created_by`, `created_at`.
- **questions** : `id`, `quiz_id`, `question_text`, `created_at`.
- **answers** : `id`, `question_id`, `answer_text`, `is_correct`, `created_at`.
