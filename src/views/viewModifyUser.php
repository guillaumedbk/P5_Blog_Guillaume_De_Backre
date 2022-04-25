<?php
session_start();
if (!isset($_SESSION['LOGGED']) || !$_SESSION['LOGGED']) {
    header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=connectForm');
}
if ($_SESSION['STATUS'] !== 'admin') {
    die('error: seul les administrateurs peuvent modifier des utilisateurs');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog - Guillaume </title>
    <!-- Favicon-->
    <link rel="icon" href=<?= $favicon; ?> />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <!-- Pour les polices-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <style>
        <?php include 'startbootstrap-freelancer-gh-pages/css/styles.css'; ?>
    </style>

</head>
<body id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-secondary border-bottom border-white text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top">GUIBLOG</a>
        <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Portfolio</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#about">CV</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#contact">Contact</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?action=listPosts">Blog</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Post creation Section-->
<section class="page-section" id="contact">
    <div class="container">
        <!-- Contact Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Modifier le user</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>

        </div>
        <!-- Contact Section Form-->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <!-- * * * * * * * * * * * * * * *-->
                <form action="index.php?action=modifyOneUser&id=<?= $user['id']; ?>" method="post">
                    <!-- Firstname input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Prénom" value="<?= $user['firstname']; ?>" required />
                        <label for="firstname">Prénom</label>
                    </div>
                    <!-- Name input-->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?= $user['name']; ?>" required />
                        <label for="name">Nom</label>
                        <div class="invalid-feedback" data-sb-feedback="name:required">Veuillez renseigner votre nom</div>
                    </div>
                    <!-- Email input-->
                    <div class="form-floating mb-3">
                        <label for="email">Email</label><br />
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" required />
                    </div>
                    <!-- Password input-->
                    <div class="form-floating mb-3">
                        <label for="password">Choisissez votre mot de passe</label><br />
                        <input type="password" class="form-control" id="password" name="password" value="<?= $user['password']; ?>"required />
                    </div>
                    <!-- Bio input-->
                    <div class="form-floating mb-3">
                        <label for="content">Biographie</label><br />
                        <textarea class="form-control" id="bio" name="bio"><?= $user['bio']; ?></textarea>
                        <div class="invalid-feedback" data-sb-feedback="message:required">Veuillez entrer votre contenu.</div>
                    </div>
                    <!-- Submit Button-->
                    <button class="btn btn-primary btn-xl" type="submit" value="Envoyer" name="userform">S'inscire</button>

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


<!-- Footer-->
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Location</h4>
                <p class="lead mb-0">
                    2215 John Daniel Drive
                    <br />
                    Clark, MO 65243
                </p>
            </div>
            <!-- Footer Social Icons-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Suivez-moi !</h4>
                <a class="btn btn-outline-light btn-social mx-1" href="https://www.facebook.com/profile.php?id=100009962677004"><i class="fab fa-fw fa-facebook-f"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="https://twitter.com/DeBackre"><i class="fab fa-fw fa-twitter"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="https://www.linkedin.com/in/guillaume-de-backre/"><i class="fab fa-fw fa-linkedin-in"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="https://github.com/guillaumedbk"><i class="fab fa-brands fa-github"></i></a>
            </div>
            <!-- Footer About Text-->
            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4">Liens utiles</h4>
                <p class="lead mb-0">
                    Freelance is a free to use, MIT licensed Bootstrap theme created by
                    <a href="http://startbootstrap.com">Start Bootstrap</a>
                    .
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Copyright Section-->
<div class="copyright py-4 text-center text-white">
    <div class="container"><small>Copyright &copy; GUIBLOG 2022</small></div>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

<script>
    /*!
* Start Bootstrap - Freelancer v7.0.5 (https://startbootstrap.com/theme/freelancer)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-freelancer/blob/master/LICENSE)
*/
    //
    // Scripts
    //

    window.addEventListener('DOMContentLoaded', event => {

        // Navbar shrink function
        var navbarShrink = function () {
            const navbarCollapsible = document.body.querySelector('#mainNav');
            if (!navbarCollapsible) {
                return;
            }
            if (window.scrollY === 0) {
                navbarCollapsible.classList.remove('navbar-shrink')
            } else {
                navbarCollapsible.classList.add('navbar-shrink')
            }

        };

        // Shrink the navbar
        navbarShrink();

        // Shrink the navbar when page is scrolled
        document.addEventListener('scroll', navbarShrink);

        // Activate Bootstrap scrollspy on the main nav element
        const mainNav = document.body.querySelector('#mainNav');
        if (mainNav) {
            new bootstrap.ScrollSpy(document.body, {
                target: '#mainNav',
                offset: 72,
            });
        };

        // Collapse responsive navbar when toggler is visible
        const navbarToggler = document.body.querySelector('.navbar-toggler');
        const responsiveNavItems = [].slice.call(
            document.querySelectorAll('#navbarResponsive .nav-link')
        );
        responsiveNavItems.map(function (responsiveNavItem) {
            responsiveNavItem.addEventListener('click', () => {
                if (window.getComputedStyle(navbarToggler).display !== 'none') {
                    navbarToggler.click();
                }
            });
        });

    });

</script>


</html>



