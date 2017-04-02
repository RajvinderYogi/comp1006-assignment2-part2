<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>

<nav class="navbar navbar-default">
    <ul class="nav nav-pills">
        <li><a href="public-website.php" class="navbar-brand">User Website</a></li>


        <?php
        session_start();

        if (empty($_SESSION['user_id'])) {

            echo '<li><a href="sign-up.php">Sign Up</a></li>
                <li><a href="sign-in.php">Sign in</a></li>';
        }
        else {



            require_once ('database-connect.php');
            $sql="SELECT * FROM websitePages";
            $cmd = $conn->prepare($sql);
            $cmd->execute();
            $websitePages = $cmd->fetchAll();
            foreach ($websitePages as $websitePage) {
                echo '<li><a href="website_public.php?page_id=' . $websitePage['page_id'] . '">' . $websitePage['page_name'] . '</a></li>';
            }
                echo '<li><a href="console.php">Back To Console</a></li>';
        }
        ?>
    </ul>

    <?php
    if (!empty($_SESSION['user_id'])) {
        echo '<div class="navbar-text pull-right">' . $_SESSION['login_name'] . '</div>';
    }

    ?>
</nav>
