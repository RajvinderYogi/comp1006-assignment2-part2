<?php ob_start();

require_once ('authorization.php');
?>


<?php
$pageTitle = 'Sign Up';
require_once ('header.php');
try {
    $user_id = null;


    if (!empty($_GET['user_id'])) {
        if (is_numeric($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
        }
    }

    if (!empty($user_id)) {

        require_once('database-connect.php');

        $sql = "DELETE FROM users WHERE user_id = :user_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $cmd->execute();

        $conn = null;
    }

    header('location:information.php');
}
catch (exception $e) {
    header('location:error.php');
}
?>

</body>
</html>

<?php ob_flush(); ?>
