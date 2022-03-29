<!DOCTYPE html>
<html lang="fr">
<head>

    <style>
        <?php include 'startbootstrap-freelancer-gh-pages/css/styles.css'; ?>
    </style>

</head>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-secondary border-bottom border-white text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="http://localhost:8888/P5_Blog_Guillaume_De_Backre/">GUIBLOG</a>
        <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="http://localhost:8888/P5_Blog_Guillaume_De_Backre/#portfolio">Portfolio</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="http://localhost:8888/P5_Blog_Guillaume_De_Backre/#about">CV</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="http://localhost:8888/P5_Blog_Guillaume_De_Backre/#contact">Contact</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?action=listPosts">Blog</a></li>

                <!-- Display connexion status -->
                <?php

                if(isset($_SESSION['LOGGED']) && $_SESSION['LOGGED']){
                    echo '<div class="btn-group">
                                <button type="button" class="btn btn-secondary dropdown-toggle p-0 text-success" data-bs-toggle="dropdown" aria-expanded="false">
                                    CONNECTÉ
                                </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="?action=disconnect" class="dropdown-item" type="button">Déconnexion</a></li>
                                        <li><button class="dropdown-item" type="button">Profil</button></li>
                                    </ul>
                                </div>';
                }else{
                    echo '<a class="py-3 px-0 px-lg-3 rounded " href="/P5_Blog_Guillaume_De_Backre/logIn">Connexion</a>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
</html>