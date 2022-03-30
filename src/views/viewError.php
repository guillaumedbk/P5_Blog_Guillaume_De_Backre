<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog -Guillaume </title>
    <!-- Favicon-->
    <link rel="icon" href= />
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
<body class="h-100 d-flex justify-content-center align-items-center flex-column">

<h1><?= $error ?></h1><br>

<p>
    <?php if(isset($solution)){
    echo $solution;
    } ?>
</p>
</body>