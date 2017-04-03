<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
<nav class="navbar navbar-default">
    <ul class="nav nav-pills">

<?php
session_start();


require_once ('database-connect.php');
$sql = "SELECT logo_id, logo_image FROM update_logo ORDER BY logo_id DESC LIMIT 1 ";

// run query and store results
$cmd = $conn->prepare($sql);
$cmd->execute();
$logos = $cmd->fetchAll();

foreach ($logos as $logo){
    echo ' <li><a href="index.php"
               class="navbar-brand">';
    if (!empty($logo['logo_image'])) {
        echo '<div><img src="images/'. $logo['logo_image'] .'"  /></div> ';

    }
    echo '</a></li>';
}


        if (empty($_SESSION['user_id'])) {

            echo '<li><a href="sign-up.php">Sign Up</a></li>
                <li><a href="sign-in.php">Sign in</a></li>';
        } else {

            echo '<li><a href="console.php">Console</a></li>
                  <li><a href="sign-out.php">Sign Out</a></li>';
        }
        ?>
    </ul>

    <?php
    if (!empty($_SESSION['user_id'])) {
        echo '<div class="navbar-text pull-right">' . $_SESSION['login_name'] . '</div>';
    }

    ?>
</nav>
<?php

ob_flush(); ?>