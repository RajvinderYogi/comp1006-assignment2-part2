<?php
$pageTitle = 'Sign In with your Account';
require_once ('header.php'); ?>

<main class="container">
    <h1>Sign in</h1>

    <?php
    if ($_GET['invalid'] == true) {
        echo '<div class="alert alert-danger" id="message">Invalid Login</div>';
    }
    else {
        echo '<div class="alert">
                <h4>Please log in your account</h4>
              </div>';
    }
    ?>

    <form method="post" action="validate.php">
        <fieldset class="form-group">
            <label for="login_name" class="col-sm-2">Username:</label>
            <input name="login_name" id="login_name" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-2">Password:</label>
            <input type="password" name="password" required />
        </fieldset>
        <fieldset class="col-sm-offset-2">
            <button class="btn btn-info">Login</button>
        </fieldset>

        <h4 class="col-sm-6">If you don't have one. <a href="sign-up.php" >Click here</a> to create a new account.</h4>
    </form>
</main>

<?php require_once('footer.php'); ?>

