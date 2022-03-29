<!DOCTYPE html>
<html lang="fr">

<style>
    a{
        text-decoration: none;
    }
    #heading{
        padding-top: 3em;
    }
    header.masthead{
        padding-bottom: 8em;
    }
</style>

<!-- Page Header-->
<header class="masthead">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading" id="heading">

                    <h3>Bonjour <?php echo $_SESSION['FIRSTNAME'] ?> et bienvenue sur le blog !</h3>
                    <span class="subheading">Découvre nos derniers posts sans plus attendre</span>
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
                <!-- Divider-->
                <hr class="my-4" />
            <?php endforeach; ?>
        </div>
    </div>
</div>
</html>