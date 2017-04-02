<?php ob_start();



$pageTitle = 'Sign Up';
require_once ('header.php');

try {
$user_id = null;
$user_name = null;
$password = null;


if (!empty($_GET['user_id'])) {
    if (is_numeric($_GET['user_id'])) {

        $user_id = $_GET['user_id'];

        require_once ('database-connect.php');

        $sql = "SELECT user_name, password FROM users WHERE user_id = :user_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $cmd->execute();
        $info = $cmd->fetch();


        $user_name = $info['user_name'];
        $password = $info['password'];


        $conn = null;
    }
}

?>

<main class="container">
    <h1>Create Your Account</h1>
    <div class="alert" id="message">
        <h4>Please fill out the easy form</h4>
    </div>

    <form method="post" action="create-account.php">
        <fieldset class="form-group">
            <label for="login_name" class="col-sm-3">Login Name</label>
            <input name="user_id" id="user_id" type="hidden" value="<?php echo $user_id; ?>"/>
            <input  name="login_name" id="login_name" required type="email" placeholder="abc@example.com"  value="<?php echo $user_name; ?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-3">Password:</label>
            <input type="password" name="password" id="password" required pattern="(?=.*\a)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
            <span id="result"></span>
        </fieldset>
        <fieldset class="form-group">
            <label for="confirm_password" class="col-sm-3">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required pattern="(?=.*\a)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
        </fieldset>
        <div class="col-sm-offset-3">
            <button class="btn btn-info btn-sm">Create Account</button>
        </div>
        <div class="col-sm-offset-2 col-lg-4">
            <label class="alert alert-warning">Password should be at least 6 character long. Please use a special character, a lowercase, a uppercase, a number</label>
        </div>
    </form>
</main>

    <?php
}
catch (exception $e) {
    header('location:error.php');
}
require_once('footer.php');
ob_flush(); ?>
