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
<?php
session_start();

try {
$logo_id = null;
$logo_image=null;



if (!empty($_GET['logo_id'])) {
    if (is_numeric($_GET['logo_id'])) {

        $logo_id = $_GET['logo_id'];
        // connect
        require_once('database-connect.php');
        $sql = "SELECT logo_image FROM update_logo WHERE logo_id = :logo_id LIMIT 1";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':logo_id', $logo_id, PDO::PARAM_INT);
        $cmd->execute();
        $logo = $cmd->fetch();


        $logo_image = $logo['logo_image'];

        $conn = null;

    }

}
?>
<nav class="navbar navbar-default">
    <ul class="nav nav-pills">
        <li><a href="index.php"
               class="navbar-brand">
                <?php
                if (!empty($logo['logo_image'])) {
                    echo '<img src="logos/' . $logo['logo_image'] . '" class="thumb" />';
                }
                ?>
            </a>
        </li>


        <?php


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
}
catch (exception $e) {
    header('location:error.php');
}
require_once('footer.php');
ob_flush(); ?>