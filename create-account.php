<?php ob_start();

require_once ('header.php');

    $login_name = $_POST['login_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_id =$_POST['user_id'];
    $ok = true;

    if (filter_var($login_name)){
        echo 'This User Name already exists';
        $ok = false;
    }
    if (empty($login_name)) {
        echo 'Username is required<br />';
        $ok = false;
    }

    if (empty($password) || (strlen($password) < 6)) {
        echo 'Password is invalid<br />';
        $ok = false;
    }

    if ($password != $confirm_password) {
        echo 'Passwords do not match<br />';
        $ok = false;
    }
try {
    if ($ok) {


        require_once('database-connect.php');


            if (empty($user_id)) {
                $sql = "INSERT INTO users (user_name, password) VALUES (:login_name, :password)";
            } else {
                $sql = "UPDATE users SET user_name = :login_name, password = :password WHERE user_id = :user_id";
            }


        $password = password_hash($password, PASSWORD_DEFAULT);


        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':login_name', $login_name, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);

        if (!empty($user_id)) {
            $cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        }
        $cmd->execute();


        $conn = null;

    echo'<p> Account is created<a href="sign-in.php">Click here</a> to sign in</p>';
    }
}
catch (exception $e) {
    header('location:error.php');
}
require_once ('footer.php');
?>


<?php ob_flush(); ?>