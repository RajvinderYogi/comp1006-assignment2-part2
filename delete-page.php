<?php ob_start();

require_once ('authorization.php');
require_once ('header.php');

try {
    $page_id = null;

    if (!empty($_GET['page_id'])) {
        if (is_numeric($_GET['page_id'])) {
            $page_id = $_GET['page_id'];
        }
    }

    if (!empty($page_id)) {

        require_once('database-connect.php');

        $sql = "DELETE FROM websitePages WHERE page_id = :page_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        $cmd->execute();

        $conn = null;
    }

    header('location:pages.php');
}
catch (exception $e) {
    header('location:error.php');
}
require_once ('footer.php');
?>


<?php ob_flush(); ?>
