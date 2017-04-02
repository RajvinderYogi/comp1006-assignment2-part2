<?php ob_start();
require_once ('authorization.php');
$pageTitle = 'Create a Page';
require_once ('header.php');

try {
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

    ?>


    <form method="post" action="create-page.php">

        <fieldset class="form-group">
            <label for="page_name">Page Title : </label>
            <input name="page_id" id="page_id"  type="hidden" value="<?php echo $page_id; ?>" />
            <input type="text" name="page_name" id="page_name" required placeholder="Title of page" value="<?php echo $page_name; ?>" />
        </fieldset>
        <fieldset class="form-group">
            <label for="page_details">Description : </label>
            <textarea id="page_details" name="page_details" cols="100" rows="5" placeholder="Description Of the page" > <?php echo $page_details; ?>
            </textarea>

        </fieldset>
        <div class="col-sm-offset-2">
            <button class="btn btn-success btnRegister">Save</button>
        </div>



    </form>


    <?php
}
catch (exception $e) {
    header('location:error.php');
}

require_once ('footer.php');
ob_flush();?>

