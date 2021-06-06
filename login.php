<?php

include "./func/config.php";

if ($_SESSION['loggedin'] !=  false) {
  $location = 'Location: index.php?login=success';
  header($location);
}
include "./func/account.php";
include "./includes/header.php";
?>

<br><br>
<div class="container mt-3 input-form">
  <div class="row">
    <div class="col-md-6">
      <h3>Create a new account</h3>
      <hr>
      <form class="" action="login.php" method="post" enctype="multipart/form-data">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" placeholder="Input your username..." value="<?php if (isset($_POST['username'])) {
                                                                                                              echo htmlspecialchars($_POST['username']);
                                                                                                            } ?>">

        <p class="error"><?php if (isset($errors['create_username'])) {
                            echo $errors['create_username'];
                          } ?></p>

        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Input your email..." value="<?php if (isset($_POST['email'])) {
                                                                                                          echo htmlspecialchars($_POST['email']);
                                                                                                        } ?>">
        <p class="error"><?php if (isset($errors['create_email'])) {
                            echo $errors['create_email'];
                          } ?></p>
        <label for="password1">Password</label>
        <input type="password" name="password1" class="form-control" placeholder="Input your password..." value="">
        <p class="error"></p>
        <label for="password2">Confirm Password</label>
        <input type="password" name="password2" class="form-control" placeholder="Confirm Password..." value="">
        <p class="error"><?php if (isset($errors['create_password'])) {
                            echo $errors['create_password'];
                          } ?></p>

        <label for="image">Avatar</label>
        <input type="file" name="image" class="form-control-file" style="padding: 3px;" value="">
        <p class="error"><?php if (isset($errors['image'])) {
                            echo $errors['image'];
                          } ?></p>
        <button style="margin-bottom: 1rem;" type="submit" name="create" class="btn btn-success">Create Account</button>
      </form>
    </div>
    <div class="col-md-6">
      <h3>Login</h3>
      <hr>
      <form class="" action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="name" class="form-control" placeholder="Input your username..." value="<?php if (isset($_POST['name'])) {
                                                                                                          echo htmlspecialchars($_POST['name']);
                                                                                                        } ?>">
        <p class="error"><?php if (isset($errors['login_username'])) {
                            echo $errors['login_username'];
                          } ?></p>
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Input your password..." value="">
        <p class="error"><?php if (isset($errors['login_password'])) {
                            echo $errors['login_password'];
                          } ?></p>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>
</div>
<br><br>

<?php
include "./includes/footer.php";
 ?>