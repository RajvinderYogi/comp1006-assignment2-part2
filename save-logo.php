<?php ob_start();
$pageTitle = 'Save logo';
require_once ('authorization.php');
require_once ('header.php');
?>



<?php

try {
    $logo_image = null;
    $ok = true;

    if (!empty($_FILES['logo_image']['name'])) {
        $image_title = $_FILES['logo_image']['name'];
        if(empty($image_title)) {
            echo '<h2 class="alert-warning" style="text-align: center">Please select a file</h2>';

        }
        $array = end(explode('.', $image_title));

        $lower = strtolower($array);


        $file_type = ['png', 'gif', 'svg'];

        if (!in_array($lower, $file_type)) {
            echo '<h2 class="alert-warning" style="text-align: center">Logo must be only three types:<br /> .png or .gif or .svg<br/></h2>';
            $ok = false;
        }

        $file_size = $_FILES['logo_image']['size'];
        if ($file_size > 5242880) {
            echo '<h2 class="alert-warning" style="text-align: center">Please select Logo less than 5 MB<br /></h2>>';
            $ok = false;
        }

        $logo_image = uniqid("") . "%$image_title";

        $temporary_name = $_FILES['logo_image']['tmp_name'];
        move_uploaded_file($temporary_name, "images/$logo_image");

    }
    if ($ok == true) {

        require_once('database-connect.php');


        if (empty($logo_id)) {
            $sql = "INSERT INTO update_logo (logo_image) VALUES (:logo_image)";
        } else {
            $sql = "UPDATE albums SET logo_image = :logo_image WHERE logo_id = :logo_id";
        }


        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':logo_image', $logo_image, PDO::PARAM_STR, 255);


        if (!empty($logo_id)) {
            $cmd->bindParam(':logo_id', $logo_id, PDO::PARAM_INT);
        }

        $cmd->execute();

        $conn = null;


        header('location:console.php');
    }


}
catch (exception $e) {
    header('location:error.php');
}
require_once ('footer.php');
?>


<?php ob_flush(); ?>
}