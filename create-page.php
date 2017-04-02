<?php ob_start();

require_once ('authorization.php');
require_once ('header.php');

    try {
        $page_name = $_POST['page_name'];
        $page_details = $_POST['page_details'];
        $page_id = $_POST['page_id'];

        $ok = true;

        if (empty($page_name)) {
            echo 'Page Title is required<br />';
            $ok = false;
        }



        if (empty($page_details)) {
            echo 'Description of page is required<br />';
            $ok = false;
        }



        if ($ok) {

            require_once('database-connect.php');

            if (empty($page_id)) {
                $sql = "INSERT INTO websitePages (page_name, page_details) VALUES (:page_name, :page_details)";
            } else {
                $sql = "UPDATE websitePages SET page_name = :page_name, page_details = :page_details WHERE page_id = :page_id";
            }

            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':page_name', $page_name, PDO::PARAM_STR, 50);
            $cmd->bindParam(':page_details', $page_details, PDO::PARAM_STR, 255);


            if (!empty($page_id)) {
                $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
            }

            $cmd->execute();

            $conn = null;

            echo'<p> Page is created<a href="pages.php">Click here</a> to see all Pages</p>';
        }
    }
    catch (exception $e) {
        header('location:error.php');
    }
    require_once ('footer.php');
    ?>


<?php ob_flush(); ?>