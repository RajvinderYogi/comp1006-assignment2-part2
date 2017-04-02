<?php ob_start();
require_once('authorization.php');
$pageTitle = 'Change the Logo';
require_once ('header.php');


?>
    <main class="container">
        <form method="post" action="save-logo.php" enctype="multipart/form-data">
            <fieldset class="form-group">
                <label for="logo_image" class="col-sm-1">LOGO:</label>
                <input name="logo_image" id="logo_image" type="file" required/>
            </fieldset>

            <input name="logo_id" id="logo_id" type="hidden" />
            <button class="btn btn-success col-sm-offset-1">Save</button>
        </form>
    </main>

<?php
require_once('footer.php');
ob_flush(); ?>