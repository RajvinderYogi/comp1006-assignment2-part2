<?php ob_start();

$login_name = $_POST['login_name'];
$password = $_POST['password'];

require_once ('database-connect.php');

$sql = "SELECT user_id, password FROM users WHERE user_name = :login_name";

$cmd = $conn->prepare($sql);
$cmd->bindParam(':login_name', $login_name, PDO::PARAM_STR, 50);
$cmd->execute();

$user = $cmd->fetch();

if (password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['login_name'] = $login_name;
    header('location:console.php');
}
else {

    header('location:sign-in.php?invalid=true');
    exit();
}

$conn = null;

ob_flush(); ?>
