<?php
include "./../db.php";
$errors = [];
if (isset($_POST["editing"])) {
    $previouspath = $_POST['img_previous'];
    $post_img_path = './assets/post_img/'. $_POST['img_previous'];
    checkInput($_POST['ptitle'], $_POST['pbody'], $errors);
    if (isset($_FILES['p-img'])) {
        if (strcmp($previouspath, 'post_default.png') != 0) {
            $filepath = "./../assets/post_img/" . $_POST['img_previous'];
            unlink($filepath);
        }
        $post_img_path = checkPimg($_FILES['p-img'], $errors);
        // $post_img_path = './assets/post_img/' . end(explode('/', checkPimg($_FILES['p-img'], $errors, 1)));
    }
    if (empty($errors)) {
        $post_id = editPost($conn, $_POST['ptitle'], $_POST['pbody'], $post_img_path, $_POST['post_id']);
        if ($post_id != 0) {
            return 1;
        }
    }
}

function editPost($conn, $title, $body, $avatarpath, $postid)
{
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $body = filter_var($body, FILTER_SANITIZE_STRING);
    $sql = "UPDATE post SET img= ? ,title= ? ,body= ? ,date_modifly = CURRENT_TIMESTAMP WHERE post.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $avatarpath, $title, $body, $postid);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
        return $stmt->insert_id;
    } else {
        return 0;
    }
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
            $directory = "./../assets/post_img/";
            $realdicretory =  "./assets/post_img/";
            $final_path = $directory . $new_fname;
            if (move_uploaded_file($tmp_name, $final_path)) {
                return $realdicretory . $new_fname;
            } else {
                $errors['p-img'] = "There was a problem uploading the file. Please upload again";
                return '';
            }
        }
    } else {
        return "./assets/post_img/post_default.png";
    }
}
