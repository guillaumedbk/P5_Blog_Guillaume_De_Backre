<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog - Guillaume </title>

    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <!-- Pour les polices-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <style>
        <?php include 'startbootstrap-freelancer-gh-pages/css/styles.css'; ?>
    </style>
</head>

<body>
<!-- Post creation Section-->
<section class="page-section" id="contact">
    <div class="container">
        <!-- Contact Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Connectez-vous</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
        </div>

        <p class="text-center mt-3">Vous n'avez pas encore de compte ? <a href="/P5_Blog_Guillaume_De_Backre/signIn">Inscrivez-vous</a></p>
        <!-- Contact Section Form-->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <form action="index.php?action=connectUser" method="post">
                    <!-- Email input-->
                    <div class="form-floating mb-3">
                        <label for="email">Email</label><br />
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                    <!-- Password input-->
                    <div class="form-floating mb-3">
                        <label for="password">Entrez votre mot de passe</label><br />
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>
                    <!-- Submit Button-->
                    <button class="btn btn-primary btn-xl" type="submit" value="Envoyer" name="connectform">Se connecter</button>

                    <!-- message display -->
                    <?php
                    if (isset($msg, $erreur)) {
                        echo $msg;
                        echo $erreur;
                    }
                    ?>

                </form>
            </div>
        </div>
    </div>
</section>
</body>

</html>