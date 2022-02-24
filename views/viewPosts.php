<?php
session_start();
if(!isset($_SESSION['LOGGED']) || !$_SESSION['LOGGED']){
    header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=connectForm');
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
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />

    <!-- Core theme CSS (includes Bootstrap)-->
    <style>

        <?php include 'startbootstrap-clean-blog-gh-pages/css/styles.css'; ?>
    </style>
</head>
<body>

<?php include('viewHeader.php') ?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Le Blog</h1>
                    <p>Bonjour <?php echo $_SESSION['FIRSTNAME'] ?> et bienvenue !</p>
                    <span class="subheading">Découvrez nos derniers posts</span>
                    <?php if($_SESSION['STATUS'] == 'admin'): ?>
                        <button class="btn btn-secondary mt-3"><a href="?action=createBlogPost">Créer un post</a></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            <?php foreach ($posts as $post): ?>
            <div class="post-preview">
                <a href="?action=post&id=<?= $post['id'] ?>">
                    <h2 class="post-title"> <?= $post['title'] ?> </h2>
                    <h3 class="post-subtitle"><?= $post['chapo'] ?> </h3>
                </a>
                <p class="post-meta">
                    Posté le <?= $post['lastUpdate'] ?>
                </p>
            </div>
            <?php endforeach; ?>

            <!-- Divider-->
            <hr class="my-4" />
        </div>
    </div>
</div>
<!-- FOOTER -->
<?php include('viewFooter.php') ?>


<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
