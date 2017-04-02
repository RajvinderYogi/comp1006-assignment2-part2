<?php ob_start();
require_once ('authorization.php');
$pageTitle = 'Admin Users';
require_once('header.php');
?>

<h1 style="text-align: center">Admin Users</h1>

<div class="accountBox"><a href="sign-up.php" >New Account</a></div>

<?php

session_start();



try {

    require_once('database-connect.php');

    $sql = "SELECT user_id, user_name FROM users ORDER BY user_name";

    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $information = $cmd->fetchAll();

    echo '<table class="table table-striped table-hover">
    <tr><th>Name</th>';

    if (!empty($_SESSION['user_id'])) {
        echo '<th>Edit</th><th>Delete</th>';
    }

    echo '</tr>';

    foreach ($information as $info) {

        echo '<tr><td>' . $info['user_name'] . '</td>';

        if (!empty($_SESSION['user_id'])) {
            echo '<td><a href="sign-up.php?user_id=' . $info['user_id'] . '" class="btn btn-primary">Edit</a></td>
            <td><a href="delete-data.php?user_id=' . $info['user_id'] . '"
            class="btn btn-danger confirmation">Delete</a></td>';
        }

        echo '</tr>';
    }

    echo '</table>';

    $conn = null;
}
catch (exception $e) {
    mail('rajvinder.yogi@mygeorgian.ca', 'Information Error', $e);
    header('location:error.php');
}
?>


<?php require_once('footer.php');
ob_flush(); ?>
