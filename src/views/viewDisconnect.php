<?php

session_start();
$_SESSION = array();
session_destroy();
header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php');
