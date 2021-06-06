<?php
$errors = [];


if (isset($_POST["submit"])) {
    //check input title body
    checkInput($_POST['ptitle'], $_POST['pbody'], $errors);
    //create post path
    $post_img_path = checkPimg($_FILES['p-img'], $errors);

    if (empty($errors)) {
        $post_id = createPost($conn, $_POST['ptitle'], $_POST['pbody'], $_SESSION['user_id'], $post_img_path);
        if ($post_id != 0) {
            $location = "Location:post.php?post_id=$post_id";
            header($location);
        }
    }
} elseif (isset($_GET["post_id"]) && !isset($_GET['editing'])) {
    $post_id = $_GET['post_id'];
    $title = '';
    $body = '';
    $author_name = '';
    $datecreate = '';
    $post_img_path = '';
    $author_img = '';
    $author_id = '';
    $no_row = true;


    $sql = "SELECT post.title, post.body, post.img as post_img, post.date_create, user.name, user.img as author_img, user.id as author_id from user,post WHERE post.id = ? and post.author = user.id
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) return;
    $row = $result->fetch_assoc();


    $title = $row['title'];
    $body = $row['body'];
    $author_name = $row['name'];
    $datecreate = $row['date_create'];
    $post_img_path = $row['post_img'];
    $author_img = $row['author_img'];
    $author_id = $row['author_id'];
    $no_row = false;
} 


function checkInput($title, $body, &$errors)
{

    //check empty
    if ($title == '' || $body == '') {
        if ($title == '') {
            $errors['ptitle'] = 'Your post title is empty';
        } else {
            $errors['pbody'] = 'Your post title is empty';
        }
        return;
    }
}
function checkPimg($file, &$errors, $size = 5000000)
{
    if (!empty($errors)) {
        return '';
    }
    if ($file['error'] == 0) {

        //check image type (extension)
        $fileType = explode('/', $file['type']);
        $fileExt = $fileType[0];
        if ($fileExt != 'image') {
            $errorMsg = "This is not an image, please change it!!";
            $errors['p-img'] = $errorMsg;
            return '';
        }

        //check size
        $fileSize = $file['size'];
        if ($fileSize > $size) {
            $errorMsg = "File is too big";
            $errors['p-img'] = $errorMsg;
            return '';
        }

        //rename file to store 
        $tmp_name = $file['tmp_name'];

        if (!isset($errors['p-img'])) {
            $new_fname = uniqid('', false) . "." . end($fileType);
            $directory = "./assets/post_img/";
            $final_path = $directory . $new_fname;
            if (move_uploaded_file($tmp_name, $final_path)) {
                return $final_path;
            } else {
                $errors['p-img'] = "There was a problem uploading the file. Please upload again";
                return '';
            }
        }
    } else {
        return "./assets/post_img/post_default.png";
    }
}

function createPost($conn, $title, $body, $author, $avatarpath)
{
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $body = filter_var($body, FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO post (img, title, body, author) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $avatarpath, $title, $body, $author);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
        return $stmt->insert_id;
    } else {
        return 0;
    }
}
