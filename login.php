<?php
    var_dump($_POST);
    $email = "";
    $password = "";

    if (isset($_POST['send'])) {
        $error =        [];
        $email =        $_POST['email'];
        $password =     $_POST['password'];

        if ($email != "" && $password != "") {

        } else {
            if ($email == "") {
                $error['email'] = 'Champs obligatoire';
            }
            
            if ($password == "") {
                $error['password'] = 'Champs obligatoire';
            }
        }
    }
?>
<?php require_once('./templates/header.php'); ?>
<div class="container">
    <form class="" action="" method="POST">
        <h1>Login</h1>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" value="<?php echo $email; ?>" class="form-control <?php if (isset($error['email'])) { ?>is-invalid <?php } ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" value="<?php echo $password; ?>" name="password" class="form-control <?php if (isset($error['password'])) { ?>is-invalid <?php } ?>" id="exampleInputPassword1">
        </div>
        <button type="submit" name="send" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php require_once('./templates/footer.php'); ?>