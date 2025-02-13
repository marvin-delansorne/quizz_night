<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style-home.css">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/style-admin.css">
    <title>Admin</title>
</head>

<body>
    <?php require_once '../includes/navbar.php'; ?>
    <main>
        <section class="achievement">
            <div class="profil_admin">
                <h1>
                    $USER
                </h1>
                <img src="/img/profil_admin.png" alt="profil_img">
                <h1>
                    Mes quizz
                </h1>
                <img src="/img/gallery_profiladmin.png" alt="gallery_profiladmin">

            </div>


            <div class="badge_all">
                <h1>
                    Badge
                </h1>

                <ul class="badge">
                    <li>
                        <img src="/img/Badge-1.png" alt="badge1">
                    </li>
                    <li>
                        <img src="/img/Badge-2.png" alt="badge2">
                    </li>
                    <li>
                        <img src="/img/Badge.png" alt="badge3">
                    </li>
                </ul>
            </div>
        </section>
        <section class="create_quizz">
            <h1>
                Creer votre porpre quizz !
            </h1>
            <input type="button" value="Créer votre propre quizz">

        </section>
    </main>

</body>

</html>