<?php
include "./func/config.php";
include "./func/getinfo.php";
include "./func/post-check.php";
include './includes/header.php';
?>
<?php if ($_SESSION['loggedin'] != true) : ?>
    <div class="jumbotron text-center">
        <h1 class="display-3">Please login first</h1>
        <br>
        <a name="" id="" class="btn btn-primary w-50" href="login.php" role="button">Login</a>
    </div>
<?php elseif (!isset($_GET['post_id']) ||  $no_row == true) : ?>
    <div class="jumbotron text-center">
        <h1 class="display-3">No post available</h1>
        <br>
        <div class="d-flex justify-content-center"><a name="" id="" class="btn btn-primary mx-5 px-5" href="createpost.php" role="button">Create Post</a>
            <a name="" id="" class="btn btn-primary mx-5 px-5" href="index.php" role="button">Homepage</a>
        </div>

    </div>
<?php else : ?>
    <br><br>
    <div class="col-lg-8 col-10 offset-lg-2 offset-1 p-0 w3l-homeblock2 post">
        <div class="card">
            <div class="align-items-center mt-3 mb-1 px-4 d-flex justify-content-between">
                <span class="author"><img src="<?php echo $author_img  ?> " alt="" class="img-fluid rounded-circle" />
                    <ul class="blog-meta">
                        <li>
                            <a href="author.php?user_id=<?php echo $author_id ?>"> <?php echo $author_name ?> </a></a>
                        </li>
                        <li class="meta-item blog-lesson">
                            <span class="meta-value"> <?php echo $datecreate  ?> </span>. <span class="meta-value ml-2"><span class="fa fa-clock-o"></span> <?php echo gettimepass($datecreate) ?></span>
                        </li>
                    </ul>
                </span>
                <?php if ($author_id === $_SESSION['user_id'] || $_SESSION['user_role'] === '2') : ?>
                    <span><i class="fa fa-ellipsis-v p-2" id="editpostdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu p-2" aria-labelledby="editpostdropdown">
                            <button type="button" id="<?php echo 'edtbtn_' . $post_id ?>" class="btn btn-primary edtbtn my-1 w-100"><i class="far fa-edit    "></i> Edit post</button> <br>
                            <!-- admin can remove any posts, other can remove their own's posts -->
                            <button type="button" id="<?php echo 'dltbtn_' . $post_id ?>" class="btn btn-danger dltbtn my-1 w-100"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>

                        </div>
                    </span>

                <?php endif ?>
            </div>
            <br>
            <div class="card-header p-0 position-relative">
                <a href="#blog-single.html">
                    <img class="card-img-bottom d-block radius-image-full" id="<?php echo 'img_' . $post_id ?>" src="<?php echo $post_img_path ?>" alt="./assets/post_img/post_default.png">
                </a>
            </div>
            <div class="card-body blog-details" id="<?php echo 'body_' . $post_id ?>">
                <a href="#" class="blog-desc"><?php echo $title  ?>
                </a>
                <p><?php echo $body  ?></p>
                <br>
                <div style="display: flex;  justify-content: space-evenly;">
                    <button type="button" id="<?php echo 'likebtn_' . $post_id ?>" class="btn btn-primary likebtn"><span class="pr-1" id="<?php echo 'likec_' . $post_id ?>"><?php echo likecount($_GET['post_id'], $conn) ?></span><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        Like</button>
                    <button type="button" id="commentbtn" class="btn btn-secondary"><i class="fa fa-comment" aria-hidden="true"></i>
                        Comment</button>
                </div>
            </div>

            <!-- form edit -->
            <form action="<?php echo "post_edit.php?post_id=$post_id&editing=1" ?>" class="w-75 edtform align-center" id="<?php echo 'edtfrm_' . $post_id ?>" style="display: none;" method="post" enctype="multipart/form-data">
                <br>
                <label for="ptitle">Post title</label>
                <input type="text" name="ptitle" class="form-control" placeholder="What do you feel?" value="<?php echo htmlspecialchars($title); ?>">
                <p class='error' id="errortitle"></p>
                <br>
                <label for="pbody">Post body</label>
                <textarea name="pbody" class="form-control" rows="5" placeholder="Tell me here..."><?php echo htmlspecialchars($body) ?></textarea>
                <p class="error"><?php if (isset($errors['pbody'])) {
                                        echo $errors['pbody'];
                                    } ?></p>
                <br>
                <label for="postimg">Post Image</label>
                <input type="file" class="form-control-file" name="p-img" placeholder="" aria-describedby="fileHelpId">
                <p class="error"><?php if (isset($errors['p-img'])) {
                                        echo $errors['p-img'];
                                    } ?></p>
                <br>
                <button type="submit" name="edit" class="btn btn-primary mb-3">Submit</button>
                <button type="btn" name="cancel" id="<?php echo 'cancel_' . $post_id ?>" class="btn btn-danger mb-3">Cancel</button>
            </form>

            <!-- form comment -->

        </div>
       
        <form action="<?php echo "getpost.php?post_id=$post_id&comment=1" ?>" class="p-3 commentform align-center" id="<?php echo 'commentfrm_' . $post_id ?>" style="display: none; opacity:0;" method="post">
        <hr>
            <h3>Comment</h3>
            <br>
            <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment here"></textarea>
            <p class='error' id="errorcomment"></p>
            <br>
            <button type="submit" name="comment" class="btn btn-primary mb-3">Add comment</button>
            <hr>
        </form>
     
        <div class="comment" id="<?php echo 'commentdiv_' . $post_id ?>">
            <!-- <div class="card border">
                <span class="d-flex justify-content-between align-items-center">
                    <span class="d-flex align-align-items-center">
                        <h5 class="card-header">Featured</h5>
                        <span class="align-self-end mx-2">commment at </span>               
                    </span>
                    <i class="fa fa-2x fa-times-circle mx-2" aria-hidden="true"></i>
                </span>
                <div class="card-body">
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
                <div class="card-footer">
                    <p></p>
                </div>
            </div> -->
        </div>
    </div>
    <script src="./assets/js/btnevent.js"></script>
    <script>
        addevent();
        processCMT();
    </script>
    <br><br>
<?php endif ?>

<?php include './includes/footer.php' ?>