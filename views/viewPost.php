<?php
session_start();
$userId = $post['userId'];
$user = getUser($userId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Clean Blog - Start Bootstrap Theme</title>
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
<header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1><?= $post['title'] ?> </h1>
                    <h2 class="subheading"><?= $post['chapo'] ?></h2>
                    <span class="meta">
                                Posté par
                                <?= $user['firstname'] . ' ' . $user['name'] ?>
                                le <?= $post['lastUpdate'] ?>
                    </span>
                    <?php if($_SESSION['STATUS'] == 'admin'): ?>
                        <button class="btn btn-secondary mt-3"><a href="?action=modifyPost&id=<?= $post['id'] ?>">Modifier</a></button>
                        <button class="btn btn-secondary mt-3"><a href="?action=deletePost&id=<?= $post['id'] ?>">Supprimer</a></button>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p><u><em>Contenu:</em></u></p>
                <p><?= $post['content'] ?></p>

                <p><u><em>Commentaires:</em></u></p>
                <?php foreach($comments as $comment): ?>
                    <p><?= $comment['content'] ?></p>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Display comments -->

                <!-- * * SB Forms Contact Form * *-->
                <form action="index.php?action=addComment&userId=<?= $_SESSION['ID'] ?>&postId=<?= $post['id'] ?>" method="post">
                    <!-- Titre input-->
                    <div class="form-floating mb-3">
                        <label for="comment">Votre commentaire</label>
                        <input type="text" class="form-control" id="comment" name="comment" required />
                    </div>
                    <!-- Submit Button-->
                    <button class="btn btn-primary btn-xl" type="submit" value="Envoyer" name="mailform">Envoyer</button>

                    <!-- message display -->
                    <?php
                    if(isset($msg)){
                        echo $msg;
                    }
                    ?>

                </form>
            </div>
        </div>

    </div>
</article>

<!-- FOOTER -->
<?php include('viewFooter.php') ?>


<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
