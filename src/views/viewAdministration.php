<?php
session_start();
if(!isset($_SESSION['LOGGED']) || !$_SESSION['LOGGED']){
    header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=connectForm');
}
if($_SESSION['STATUS'] != 'admin'){
    die ('error: seul les administrateurs peuvent accéder à cette page');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administration</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        <?php include 'startbootstrap-sb-admin-2-gh-pages/css/sb-admin-2.css'; ?>
    </style>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://localhost:8888/P5_Blog_Guillaume_De_Backre">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">GUIBLOG</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="?action=administration">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>



        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="../../index.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Charts</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item active">
            <a class="nav-link" href="../../index.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Posts</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Tables</h1>

                <?php if($waitingComments): ?>
                <!-- DataTales -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Commentaires en attente de validation</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Post preview-->

                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Commentaire</th>
                                    <th>Date de publication:</th>
                                    <th>Accepter</th>
                                    <th>Refuser</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($waitingComments as $comment): ?>
                                    <tr>
                                        <td><?= $comment['id'] ?></td>
                                        <td><?= $comment['content'] ?></td>
                                        <td><?= $comment['publishAt'] ?></td>
                                        <td><button class="btn-secondary btn-sm"><a href="?action=acceptComment&id=<?= $comment['id'] ?>" style="color: white">Accepter</a></button></td>
                                        <td><button class="btn btn-danger btn-sm"><a href="?action=deleteComment&id=<?= $comment['id'] ?>" style="color: white">Refuser</a></button></td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <!-- DataTales -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables Posts</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Post preview-->

                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                    <th>Id</th>
                                    <th>Titre</th>
                                    <th>Chapo</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Author</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($posts as $post): ?>
                                    <tr>
                                        <td><button class="btn-secondary btn-sm"><a href="?action=modifyPost&id=<?= $post['id'] ?>" style="color: white">Modifier</a></button></td>
                                        <td><button class="btn btn-danger btn-sm"><a href="?action=deletePost&id=<?= $post['id'] ?>" style="color: white">Supprimer</a></button></td>
                                        <td><?= $post['id'] ?></td>
                                        <td><?= $post['title'] ?></td>
                                        <td><?= $post['chapo'] ?></td>
                                        <td><?= $post['content'] ?></td>
                                        <td><?= $post['lastUpdate'] ?></td>
                                        <td><?= $post['userId'] ?></td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- DataTales -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables Users</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Post preview-->
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Modifier status</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                    <th>Id</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Bio</th>
                                    <th>Password</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td>
                                            <?php if($user['status'] == 'admin'): ?>
                                            <a href="?action=modifyStatus&id=<?= $user['id'] ?>&status=utilisateur" style="color: black">Rendre Utilisateur</a>
                                            <?php elseif ($user['status'] == 'utilisateur'):?>
                                            <a href="?action=modifyStatus&id=<?= $user['id'] ?>&status=admin" style="color: black">Rendre Admin</a>
                                            <?php endif; ?>
                                        </td>
                                        <td><button class="btn-secondary btn-sm"><a href="?action=modifyUser&id=<?= $user['id'] ?>" style="color: white">Modifier</a></button></td>
                                        <td><button class="btn btn-danger btn-sm"><a href="?action=deleteUser&id=<?= $user['id'] ?>" style="color: white">Supprimer</a></button></td>
                                        <td><?= $user['id'] ?></td>
                                        <td><?= $user['firstname'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['status'] ?></td>
                                        <td><?= $user['bio'] ?></td>
                                        <td><?= $user['password'] ?></td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

</body>

</html>