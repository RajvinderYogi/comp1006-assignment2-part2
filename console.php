<?php
require_once ('authorization.php');
$pageTitle = 'CMS';
require_once('header.php'); ?>

    <div class="container">

        <section>
            <h1 class="alert" style="text-align: center">Console Page</h1>
            <h4 style="text-align: center">You can Create, Edit, and Delete Admin accounts.<br>
                    You can Manage you pages for public website.<br>
                    You can update your logo.</h4>
        </section>
        <a class="col-xs-6 col-sm-4 box" href="information.php">Administrator</a>
        <a class="col-xs-6 col-sm-4 box" href="pages.php">Pages</a>
        <a class="col-xs-6 col-sm-4 box" href="change-logo.php">Logo</a>
        <a class="col-xs-6 col-sm-4 box" href="sign-up.php">Create an Account</a>
    </div>

<?php
require_once('footer.php');
?>