<?php
ob_start();

require_once ('header_public.php');


$page_id = null;
$page_name = null;
$page_details = null;

if (!empty($_GET['page_id'])) {
    if (is_numeric($_GET['page_id'])) {

        $page_id = $_GET['page_id'];

        require_once ('database-connect.php');

        $sql = "SELECT page_name, page_details FROM websitePages WHERE page_id = :page_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        $cmd->execute();
        $page = $cmd->fetch();

        $page_name = $page['page_name'];
        $page_details = $page['page_details'];


        $conn = null;
    }
}
echo '<title>'.$websitePage['page_name'].'</title>';


?>
<h1 class="well" style="text-align: center;"><?php echo $page_name ?></h1>
<section class="col-lg-pull-4"><h4><?php echo $page_details ?></h4></section>

<?php
require_once ('footer.php');
ob_flush();
?>
