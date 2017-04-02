<?php ob_start();

$pageTitle = 'Pages';
require_once('header.php'); ?>

<h1>Pages</h1>

<a class="col-sm-6 pageBox" href="add-page.php">Add Page</a>
<a class="col-sm-6 pageBox" href="public-website.php">Visit Website</a>

<?php

session_start();



try {
    require_once('database-connect.php');

    $sql = "SELECT page_id, page_name, page_details FROM websitePages ORDER BY page_id";

    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $webPages = $cmd->fetchAll();

    echo '<table class="table  table-responsive">
    <tr><th>Page Title</th>';

    if (!empty($_SESSION['user_id'])) {
        echo '<th>Edit</th><th>Delete</th>';
    }

    echo '</tr>';
    foreach ($webPages as $webPage) {
        echo '<tr><td>' . $webPage['page_name'] . '</td>';




        if (!empty($_SESSION['user_id'])) {
            echo '<td><a href="add-page.php?page_id=' . $webPage['page_id'] . '" class="btn btn-info">Edit</a></td>
            <td><a href="delete-page.php?page_id=' . $webPage['page_id'] . '" class="btn btn-danger confirmation">Delete</a></td>';
        }

        echo '</tr>';
    }

    echo '</table>';
    $conn = null;
}
catch (exception $e) {
    mail('rajvinder.yogi@mygeorgian.ca', 'pageError', $e);
    header('location:error.php');
}
?>

<?php require_once('footer.php');
ob_flush(); ?>
