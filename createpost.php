<?php
include "./func/config.php";
include "./func/post-check.php"; //?

include './includes/header.php';


?>

<?php if ($_SESSION['loggedin'] != true): ?>
<div class="jumbotron text-center">
    <h1 class="display-3">Please login first</h1>
    <br>
    <a name="" id="" class="btn btn-primary w-50" href="login.php" role="button">Login</a>
</div>

<?php else: ?>
<div class="jumbotron text-center">
    <h1 class="display-3">Create Post</h1>
</div>

<form action="createpost.php" method="post" enctype="multipart/form-data"
    class="col-lg-8 col-10 offset-lg-2 offset-1 d-flex flex-column">
    <label for="ptitle">Post title</label>
    <input type="text" name="ptitle" class="form-control" placeholder="What do you feel?" value="<?php if (isset($_POST['ptitle'])) {
                                                                                                        echo htmlspecialchars($_POST['ptitle']);
                                                                                                    } ?>">
    <p class="error"><?php if (isset($errors['ptitle'])) {
                            echo $errors['ptitle'];
                        } ?></p>
    <br>
    <label for="pbody">Post body</label>
    <textarea name="pbody" class="form-control" id="" rows="5" placeholder="Tell me here..."><?php if (isset($_POST['pbody'])) {
                                                                                                    echo htmlspecialchars($_POST['pbody']);
                                                                                                } ?></textarea>
    <p class="error"><?php if (isset($errors['pbody'])) {
                            echo $errors['pbody'];
                        } ?></p>
    <br>
    <label for="postimg">Post Image</label>
    <input type="file" class="form-control-file" name="p-img" id="" placeholder="" aria-describedby="fileHelpId">
    <p class="error"><?php if (isset($errors['p-img'])) {
                            echo $errors['p-img'];
                        } ?></p>
    <br>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

<br><br>
<?php endif ?>

<?php include './includes/footer.php' ?>