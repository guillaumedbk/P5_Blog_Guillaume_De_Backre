<?php
session_start();
if (!isset($_SESSION['LOGGED']) || !$_SESSION['LOGGED']) {
    header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=connectForm');
}
if ($_SESSION['STATUS'] != 'admin') {
    die('error: seul les administrateurs peuvent ajouter des posts');
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
        <link rel="icon" href=<?= $favicon ?> />
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
            body{
                height: 100%;
                min-height: 100vh;
            }
        </style>
    </head>

    <body id="page-top">

        <?php include('viewHeader.php') ?>

        <!-- Post creation Section-->
        <section class="page-section" id="contact">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Créez votre post</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>

                </div>
                <!-- Contact Section Form-->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <form action="index.php?action=addPost&id=<?= $_SESSION['ID'] ?>" method="post">
                            <!-- Titre input-->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="comment" name="title" placeholder="Titre du post" required />
                                <label for="comment">Titre du post</label>
                            </div>
                            <!-- Chapo input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="chapo" name="chapo" placeholder="Chapo"></textarea>
                                <label for="chapo">Châpo</label><br />
                            </div>
                            <!-- Content input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="comment" name="content" placeholder="Votre contenu"></textarea>
                                <label for="content">Votre contenu</label><br />
                            </div>

                            <!-- Submit Button-->
                            <button class="btn btn-primary btn-xl" type="submit" value="Envoyer" name="mailform">Envoyer</button>

                            <!-- message display -->
                            <?php
                            if (isset($msg)) {
                                echo $msg;
                            }
                            ?>

                        </form>
                    </div>
                </div>
            </div>
        </section>


        <!-- FOOTER -->
        <?php include('viewFooter.php') ?>

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

