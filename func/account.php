<?php
//user errors assoc array to track errors and use as a bool
// decide on log in / creating account. Passed by reference
$errors = [];
if (isset($_POST['login'])) {
  // process the login form, pass the post, errors (by ref) and db CONN
  checkLogin($_POST, $errors, $conn);
} elseif (isset($_POST['create'])) {
  // process the create form, pass the post, errors (by ref) and db CONN
  checkCreate($_POST, $errors, $conn);
}

//check the login form for errors
function checkLogin($post, &$errors, $conn)
{
  $name = $_POST['name'];
  $password = $_POST['password'];
  //username checks, first check db if user exists
  // checkforuser() returns either 0 (doesnt exist) or the user ID
  if (checkForUser($name, $conn) != 1) {
    $errorMsg = "Username not found!";
    $errors['login_username'] = $errorMsg;
  } else {
    // if user exists, get their record and check the user submitted pw
    // against the hash in the DB
    $user_row = getUserRow($name, $conn);
    if (!password_verify($password, $user_row['pwhash'])) {
      $errorMsg = "Incorred Password!";
      $errors['login_password'] = $errorMsg;
    }
  }
  // if there are no errors in the array then login and redirect
  if (empty($errors)) {
    loginUser($user_row['name'], $user_row['id'], $user_row['role'],$user_row['img']);
  }
}

// checks the create new user form
function checkCreate($post, &$errors, $conn)
{
  $username = $post['username'];
  $email = $post['email'];
  $password1 = $post['password1'];
  $password2 = $post['password2'];
  //check img below

  //check username length, the ensure the name doesn't exist in the DB
  if (!minmaxChars($username, 5, 20)) {
    $errorMsg = "Username must be between 5-20 characters long!";
    $errors['create_username'] = $errorMsg;
  } elseif (checkForUser($username, $conn) == 1) {
    $errorMsg = "Username already take!";
    $errors['create_username'] = $errorMsg;
  }
  // validate email, should add sanitation as well
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMsg = "Invalid email!";
    $errors['create_email'] = $errorMsg;
  }
  // check pw length and matching
  if (!minmaxChars($password1, 5) || $password1 != $password2) {
    $errorMsg = "Password is too short or does not match!";
    $errors['create_password'] = $errorMsg;
  }


  $avatarpath =  checkAvatar($_FILES['image'], $errors);

  // if there are no errors, insert the user into the db and login

  if (empty($errors)) {
    $user_id = createUser($conn, $username, $email, $password1, $avatarpath);
    if ($user_id != 0) {
      loginUser($username, $user_id, 1,$avatarpath);
    }
  }
}

//query the DB to see if a user exists. returns num_rows
function checkForUser($username, $conn)
{
  $sql = "SELECT * FROM user WHERE name = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $results = $stmt->get_result();
  return $results->num_rows;
}

// fetch a user from the DB based on username
function getUserRow($username, $conn)
{
  $sql = "SELECT * FROM user WHERE name = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $results = $stmt->get_result();
  return $results->fetch_assoc();
}

//check avatar 
function checkAvatar($file, &$errors, $size = 5000000)
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
      $errors['image'] = $errorMsg;
      return '';
    }

    //check size
    $fileSize = $file['size'];
    if ($fileSize > $size) {
      $errorMsg = "File is too big";
      $errors['image'] = $errorMsg;
      return '';
    }

    //rename file to store 
    $tmp_name = $file['tmp_name'];

    if (!isset($errors['image'])) {
      $new_fname = uniqid('', false) . "." . end($fileType);
      $final_path = "./assets/images/" . $new_fname;
      if (move_uploaded_file($tmp_name, $final_path)) {
        return $final_path;
      } else {
        $errors['image'] = "There was a problem uploading the file.";
        return '';
      }
    }
  } else {
    return "./assets/images/avatar_default.jpg";
  }
}

// inserts a new user into the db
function createUser($conn, $user_name, $user_email, $user_password, $avatarpath)
{
  $user_hash = password_hash($user_password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO user (name, email, pwhash, img) VALUES (?,?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $user_name, $user_email, $user_hash, $avatarpath);
  $stmt->execute();
  if ($stmt->affected_rows == 1) {
    return $stmt->insert_id;
  } else {
    return 0;
  }
}

// character length checker
function minmaxChars($string, $min, $max = 1000)
{
  if (strlen($string) < $min || strlen($string) > $max) {
    return false;
  } else {
    return true;
  }
}

// log user in function, sets $_SESSION values and redirects to home
function loginUser($user_name, $user_id, $user_role, $user_img)
{
  $_SESSION['loggedin'] = true;
  $_SESSION['user_name'] = $user_name;
  $_SESSION['user_id'] = $user_id;
  $_SESSION['user_role'] = $user_role;
  $_SESSION['img'] = $user_img;
  header("Location: index.php?login=success");
}